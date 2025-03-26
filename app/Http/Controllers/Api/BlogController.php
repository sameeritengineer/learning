<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
	public function index(Request $request)
	{
	    $perPage = $request->query('per_page', 10); // Default per page
	    $categoryId = $request->query('category_id'); // Get category_id from request

	    // Fetch posts, filtering by category if provided
	    $query = Blog::with('category')->orderByDesc('created_at');
	    
	    if ($categoryId) {
	        $query->where('category_id', $categoryId);
	    }

	    $posts = $query->paginate($perPage);

	    // Return JSON response
	    return response()->json([
	        'status' => true,
	        'message' => 'Blog posts retrieved successfully',
	        'data' => $posts->items(), // The actual blog posts
	        'pagination' => [
	            'total' => $posts->total(),
	            'per_page' => $posts->perPage(),
	            'current_page' => $posts->currentPage(),
	            'last_page' => $posts->lastPage(),
	            'from' => $posts->firstItem(),
	            'to' => $posts->lastItem(),
	            'next_page_url' => $posts->nextPageUrl(),
	            'prev_page_url' => $posts->previousPageUrl(),
	        ],
	    ]);
	}

	public function show($id)
	{
	    // Fetch the blog post with its category
	    $post = Blog::with('category')->find($id);

	    // Check if post exists
	    if (!$post) {
	        return response()->json([
	            'status' => false,
	            'message' => 'Post not found',
	        ], 404);
	    }

	    // Return response
	    return response()->json([
	        'status' => true,
	        'message' => 'Blog post retrieved successfully',
	        'data' => $post
	    ]);
	}


    public function getTopFeaturedPosts()
    {
        $posts = Blog::with('category')->where('is_featured', true)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get(['id', 'title', 'slug', 'thumbnail_image', 'created_at','category_id']);

        return response()->json([
            'success' => true,
            'data' => $posts,
        ], 200);
    }
}
