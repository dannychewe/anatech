<?php

// app/Http/Controllers/Frontend/NewsletterController.php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterConfirmMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class NewsletterController extends Controller
{
    // Toggle this to true if you want double opt-in
    private bool $doubleOptIn = false;

    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email:rfc,dns|max:255',
            'name'  => 'nullable|string|max:100',
        ]);

        $subscriber = NewsletterSubscriber::firstOrNew(['email' => strtolower($data['email'])]);
        // Already unsubscribed? Re-activate
        if ($subscriber->exists && $subscriber->status === 'subscribed') {
            return back()->with('success', 'You are already subscribed. Thank you!');
        }

        $subscriber->name = $data['name'] ?? $subscriber->name;
        if ($this->doubleOptIn) {
            $subscriber->status = 'pending';
            $subscriber->confirm_token = Str::random(48);
            $subscriber->confirm_token_expires_at = now()->addDays(3);
            $subscriber->save();

            $confirmUrl = URL::temporarySignedRoute(
                'newsletter.confirm',
                now()->addDays(3),
                ['id' => $subscriber->id, 'token' => $subscriber->confirm_token]
            );

            try { Mail::to($subscriber->email)->send(new NewsletterConfirmMail($subscriber, $confirmUrl)); }
            catch (\Throwable $e) { report($e); /* don’t block UX */ }

            return back()->with('success', 'Please check your email to confirm your subscription.');
        } else {
            $subscriber->status = 'subscribed';
            $subscriber->subscribed_at = now();
            $subscriber->confirm_token = null;
            $subscriber->confirm_token_expires_at = null;
            $subscriber->unsubscribed_at = null;
            $subscriber->save();

            return back()->with('success', 'Subscribed! Thanks for joining our newsletter.');
        }
    }

    public function confirm(Request $request, $id)
    {
        $request->validate(['token' => 'required|string']);
        abort_unless($request->hasValidSignature(), 403);

        $s = NewsletterSubscriber::findOrFail($id);
        if ($s->status !== 'pending' || !$s->confirm_token || $s->confirm_token !== $request->token) {
            return redirect()->route('home')->with('error', 'Invalid confirmation link.');
        }
        if ($s->confirm_token_expires_at && now()->greaterThan($s->confirm_token_expires_at)) {
            return redirect()->route('home')->with('error', 'Confirmation link expired.');
        }

        $s->status = 'subscribed';
        $s->subscribed_at = now();
        $s->confirm_token = null;
        $s->confirm_token_expires_at = null;
        $s->save();

        return redirect()->route('home')->with('success', 'Subscription confirmed. Welcome!');
    }

    public function unsubscribe(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email:rfc,dns'
        ]);
        $s = NewsletterSubscriber::where('email', strtolower($data['email']))->first();
        if (!$s || $s->status === 'unsubscribed') {
            return back()->with('success', 'You are already unsubscribed.');
        }
        $s->status = 'unsubscribed';
        $s->unsubscribed_at = now();
        $s->save();

        return back()->with('success', 'You have been unsubscribed.');
    }
}

