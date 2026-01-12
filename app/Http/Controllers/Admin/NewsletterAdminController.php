<?php

// app/Http/Controllers/Admin/NewsletterAdminController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterCampaignMail;
use App\Models\NewsletterCampaign;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class NewsletterAdminController extends Controller
{
    private function applyFilters(Request $request)
    {
        $status = $request->get('status');
        $q = $request->get('q');

        $query = NewsletterSubscriber::query()->latest();

        if ($status) {
            $query->where('status', $status);
        }

        if ($q) {
            $query->where(function ($qq) use ($q) {
                $qq->where('email', 'like', "%{$q}%")
                   ->orWhere('name', 'like', "%{$q}%");
            });
        }

        return $query;
    }

    public function index(Request $request)
    {
        $subs = $this->applyFilters($request)
            ->paginate(30)
            ->appends($request->only('status', 'q'));

        return view('admin.newsletter.subscribers', compact('subs'));
    }

    public function exportCsv(Request $request)
    {
        $subs = $this->applyFilters($request)->get();

        return response()->streamDownload(function () use ($subs) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Email', 'Name', 'Status', 'Subscribed At', 'Unsubscribed At']);

            foreach ($subs as $s) {
                fputcsv($handle, [
                    $s->email,
                    $s->name,
                    $s->status,
                    optional($s->subscribed_at)->toDateTimeString(),
                    optional($s->unsubscribed_at)->toDateTimeString(),
                ]);
            }

            fclose($handle);
        }, 'subscribers.csv', ['Content-Type' => 'text/csv']);
    }

    public function exportPdf(Request $request)
    {
        $subs = $this->applyFilters($request)->get();
        $pdf = Pdf::loadView('admin.newsletter.export-pdf', compact('subs'));
        return $pdf->download('subscribers.pdf');
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

        if (empty($data['text'])) {
            $data['text'] = trim(strip_tags($data['html']));
        }

        $campaign = NewsletterCampaign::create($data);

        // Queue sends (recommended). For brevity, we'll send inline here.
        $subs = NewsletterSubscriber::subscribed()->pluck('email')->all();
        if (empty($subs)) {
            return redirect()->route('admin.newsletter.index')
                ->with('warning', 'No subscribed users to send this campaign to.');
        }

        foreach ($subs as $email) {
            // Consider dispatching a Job here for scale
            try { Mail::to($email)->queue(new NewsletterCampaignMail($campaign->subject, $campaign->html, $campaign->text)); }
            catch (\Throwable $e) { report($e); }
        }

        $campaign->update(['sent_at' => now()]);
        return redirect()->route('admin.newsletter.index')->with('success', 'Campaign queued to subscribers.');
    }
}
