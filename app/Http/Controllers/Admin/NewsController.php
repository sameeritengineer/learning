<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller {

	public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create_edit');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'whole_news' => 'required|string',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('thumbnail_image')) {
            $validated['thumbnail_image'] = $request->file('thumbnail_image')->store('news', 'public');
        }

        News::create($validated);
        return redirect()->route('news.index')->with('success', 'News added successfully!');
    }

    public function edit(News $news)
    {
        return view('admin.news.create_edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'whole_news' => 'required|string',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('thumbnail_image')) {
            Storage::disk('public')->delete($news->thumbnail_image);
            $validated['thumbnail_image'] = $request->file('thumbnail_image')->store('news', 'public');
        }

        $news->update($validated);
        return redirect()->route('news.index')->with('success', 'News updated successfully!');
    }

    public function destroy(News $news)
    {
        Storage::disk('public')->delete($news->thumbnail_image);
        $news->delete();
        return back()->with('success', 'News deleted successfully!');
    }

}