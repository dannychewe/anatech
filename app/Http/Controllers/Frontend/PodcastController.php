<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Podcast;

class PodcastController extends Controller
{
    public function index()
    {
        $podcasts = Podcast::latest()->paginate(12);
        return view('frontend.podcasts.index', compact('podcasts'));
    }

    public function show($slug)
    {
        $podcast = Podcast::where('slug', $slug)->firstOrFail();
        return view('frontend.podcasts.show', compact('podcast'));
    }
}
