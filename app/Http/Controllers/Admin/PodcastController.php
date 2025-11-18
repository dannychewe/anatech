<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PodcastController extends Controller
{
    public function index()
    {
        $podcasts = Podcast::latest()->paginate(10);
        return view('admin.podcasts.index', compact('podcasts'));
    }

    public function create()
    {
        return view('admin.podcasts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:podcasts,slug',
            'embed_url' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('podcasts', 'public');
        }

        Podcast::create($data);

        return redirect()->route('admin.podcasts.index')->with('success', 'Podcast created successfully.');
    }

    public function edit(Podcast $podcast)
    {
        return view('admin.podcasts.edit', compact('podcast'));
    }

    public function update(Request $request, Podcast $podcast)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:podcasts,slug,' . $podcast->id,
            'embed_url' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);

        // Handle thumbnail upload & replacement
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($podcast->thumbnail && Storage::disk('public')->exists($podcast->thumbnail)) {
                Storage::disk('public')->delete($podcast->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('podcasts', 'public');
        }

        $podcast->update($data);

        return redirect()->route('admin.podcasts.index')->with('success', 'Podcast updated successfully.');
    }

    public function destroy(Podcast $podcast)
    {
        // Delete thumbnail if exists
        if ($podcast->thumbnail && Storage::disk('public')->exists($podcast->thumbnail)) {
            Storage::disk('public')->delete($podcast->thumbnail);
        }

        $podcast->delete();

        return redirect()->route('admin.podcasts.index')->with('success', 'Podcast deleted successfully.');
    }
}
