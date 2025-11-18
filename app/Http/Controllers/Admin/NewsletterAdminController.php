<?php

// app/Http/Controllers/Admin/NewsletterAdminController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterCampaignMail;
use App\Models\NewsletterCampaign;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterAdminController extends Controller
{
    public function index()
    {
        $subs = NewsletterSubscriber::latest()->paginate(30);
        return view('admin.newsletter.subscribers', compact('subs'));
    }

    public function exportCsv()
    {
        $subs = NewsletterSubscriber::all();
        $csv = "Email,Name,Status,Subscribed At,Unsubscribed At\n";
        foreach ($subs as $s) {
            $csv .= sprintf(
                "\"%s\",\"%s\",%s,%s,%s\n",
                $s->email, $s->name, $s->status,
                optional($s->subscribed_at)->toDateTimeString(),
                optional($s->unsubscribed_at)->toDateTimeString()
            );
        }
        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="subscribers.csv"'
        ]);
    }

    public function createCampaign()
    {
        return view('admin.newsletter.campaign_create');
    }

    public function storeCampaign(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|string|max:255',
            'html'    => 'required|string',
            'text'    => 'nullable|string'
        ]);

        $campaign = NewsletterCampaign::create($data);

        // Queue sends (recommended). For brevity, we'll send inline here.
        $subs = NewsletterSubscriber::subscribed()->pluck('email')->all();
        foreach ($subs as $email) {
            // Consider dispatching a Job here for scale
            try { Mail::to($email)->queue(new NewsletterCampaignMail($campaign->subject, $campaign->html, $campaign->text)); }
            catch (\Throwable $e) { report($e); }
        }

        $campaign->update(['sent_at' => now()]);
        return redirect()->route('admin.newsletter.index')->with('success', 'Campaign queued to subscribers.');
    }
}
