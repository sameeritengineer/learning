<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogCategory;

class BlogCategoriesController extends Controller
{

 public function index(){

 	$blogCategories = BlogCategory::withCount('blog')->orderBy('id', 'desc')->get();


    $data = [
        'blogCategories' => $blogCategories
    ];

 	return view('admin.blog.categories', $data);

  }

  public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|string|unique:blog_categories',
        ]);

        $data = $request->all();
        $blogCategory = BlogCategory::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null
        ]);

        return redirect('/admin/blog/categories');
    }

    public function edit($category_id)
    {

        $editCategory = BlogCategory::findOrFail($category_id);

        $data = [
            'editCategory' => $editCategory
        ];

        return view('admin.blog.categories', $data);
    }

    public function update(Request $request, $category_id)
    {

        $request->validate([
        'title' => 'required|string|unique:blog_categories',
        ]);

        $data = $request->all();
        $editCategory = BlogCategory::findOrFail($category_id);
        $editCategory->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? null
        ]);

        return redirect('/admin/blog/categories');
    }


}