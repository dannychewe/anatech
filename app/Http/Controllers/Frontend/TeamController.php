<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;

class TeamController extends Controller
{
    public function index()
    {
        $members = TeamMember::latest()->get();
        return view('frontend.team.index', compact('members'));
    }

    public function show($slug)
    {
        $member = TeamMember::where('slug', $slug)->firstOrFail();
        return view('frontend.team.show', compact('member'));
    }

}
