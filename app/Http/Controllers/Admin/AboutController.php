<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('admin.about.index', compact('about'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'why_choose_us' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        $about = About::first();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($about && $about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }
            // Store new image (folder auto-created)
            $data['image'] = $request->file('image')->store('about', 'public');
        }

        if (!$about) {
            About::create($data);
        } else {
            $about->update($data);
        }

        return redirect()->route('admin.about.index')->with('success', 'About Us updated successfully.');
    }
}
