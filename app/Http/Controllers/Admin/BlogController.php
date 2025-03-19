<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the blogs.
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->get();
        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new blog.
     */
    public function create()
    {
         $categories = BlogCategory::all();
         return view('admin.blog.form', compact('categories'));
    }

    /**
     * Store a newly created blog in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'mini_description' => 'nullable|string|max:255',
            'category_id' => 'required|exists:blog_categories,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
        ]);

        // Handle file uploads
        $coverImage = $request->file('cover_image') ? $request->file('cover_image')->store('uploads/blogs', 'public') : null;
        $thumbnailImage = $request->file('thumbnail_image') ? $request->file('thumbnail_image')->store('uploads/blogs/thumbnails', 'public') : null;

        Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'mini_description' => $request->mini_description,
            'category_id' => $request->category_id,
            'cover_image' => $coverImage,
            'thumbnail_image' => $thumbnailImage,
            'status' => $request->status,
            'is_featured' => $request->is_featured ?? 0,
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'Blog created successfully!');
    }

    /**
     * Show the form for editing the specified blog.
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
	    $categories = BlogCategory::all();
	    return view('admin.blog.form', compact('blog', 'categories'));
    }

    /**
     * Update the specified blog in the database.
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'mini_description' => 'nullable|string|max:255',
            'category_id' => 'required|exists:blog_categories,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
        ]);

        // Handle file uploads
        if ($request->file('cover_image')) {
            $coverImage = $request->file('cover_image')->store('uploads/blogs', 'public');
            $blog->cover_image = $coverImage;
        }
        if ($request->file('thumbnail_image')) {
            $thumbnailImage = $request->file('thumbnail_image')->store('uploads/blogs/thumbnails', 'public');
            $blog->thumbnail_image = $thumbnailImage;
        }

        $blog->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'mini_description' => $request->mini_description,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'is_featured' => $request->is_featured ?? 0,
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'Blog updated successfully!');
    }

    /**
     * Delete the specified blog from the database.
     */
    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Blog deleted successfully!');
    }

    /**
     * Search for blogs based on a keyword.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $blogs = Blog::where('title', 'like', "%$query%")->orWhere('description', 'like', "%$query%")->get();
        return view('admin.blog.index', compact('blogs'));
    }
}
