<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PressRelease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PressReleaseController extends Controller {

public function index()
    {
        $pressReleases = PressRelease::latest()->paginate(10);
        return view('admin.press_release.index', compact('pressReleases'));
    }

    public function create()
    {
        return view('admin.press_release.create_edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'whole_press_release' => 'required|string',
            'thumbnail_image' => 'nullable|image|max:2048'
        ]);

        $imagePath = $request->file('thumbnail_image') 
            ? $request->file('thumbnail_image')->store('press_releases', 'public')
            : null;

        PressRelease::create([
            'title' => $request->title,
            'description' => $request->description,
            'whole_press_release' => $request->whole_press_release,
            'thumbnail_image' => $imagePath
        ]);

        return redirect()->route('press-release.index')->with('success', 'Press Release created successfully.');
    }

    public function edit(PressRelease $pressRelease)
    {
        return view('admin.press_release.create_edit', compact('pressRelease'));
    }

    public function update(Request $request, PressRelease $pressRelease)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'whole_press_release' => 'required|string',
            'thumbnail_image' => 'nullable|image|max:2048'
        ]);

        if ($request->file('thumbnail_image')) {
            if ($pressRelease->thumbnail_image) {
                Storage::disk('public')->delete($pressRelease->thumbnail_image);
            }
            $imagePath = $request->file('thumbnail_image')->store('press_releases', 'public');
        } else {
            $imagePath = $pressRelease->thumbnail_image;
        }

        $pressRelease->update([
            'title' => $request->title,
            'description' => $request->description,
            'whole_press_release' => $request->whole_press_release,
            'thumbnail_image' => $imagePath
        ]);

        return redirect()->route('press-release.index')->with('success', 'Press Release updated successfully.');
    }

    public function destroy(PressRelease $pressRelease)
    {
        if ($pressRelease->thumbnail_image) {
            Storage::disk('public')->delete($pressRelease->thumbnail_image);
        }

        $pressRelease->delete();
        return redirect()->route('press-release.index')->with('success', 'Press Release deleted successfully.');
    }

}