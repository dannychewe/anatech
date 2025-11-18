<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\TeamMember;
use Illuminate\Http\Request;           // ⬅ import Request
use App\Models\Contact;    


class PageController extends Controller
{
    public function about()
    {
        $about = About::first();
        $teamMembers = TeamMember::latest()->get();
        return view('frontend.pages.about', compact('about', 'teamMembers'));
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function submitContact(Request $request)
{
    $data = $request->validate([
        'name'    => [
            'required',
            'string',
            'max:255',
            'regex:/^[a-zA-Z\s\.\'\-]+$/u' // letters, spaces, dots, apostrophes, hyphens
        ],
        'email'   => 'required|email:rfc,dns|max:255',
        'phone'   => [
            'nullable',
            'string',
            'max:30',
            'regex:/^[0-9\+\-\s\(\)]+$/u' // digits, +, -, spaces, ()
        ],
        'subject' => [
            'nullable',
            'string',
            'max:255',
            'regex:/^[a-zA-Z0-9\s\.\,\!\?\-\'"]+$/u' // alphanumeric with common punctuation
        ],
        'message' => 'required|string|max:2000',
        'website' => 'nullable|string|max:0', // honeypot
    ]);

    // Honeypot: if filled, treat as spam
    if (!empty($data['website'])) {
        return back()->with('error', 'Spam detected.')->withInput();
    }

    Contact::create([
        'name'    => $data['name'],
        'email'   => $data['email'],
        'phone'   => $data['phone'] ?? null,
        'subject' => $data['subject'] ?? null,
        'message' => $data['message'],
    ]);

    return back()->with('success', 'Thanks! Your message has been sent.');
}

}
