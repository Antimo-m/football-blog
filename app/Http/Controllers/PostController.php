<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with('category', 'teams');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }


        $posts = $query->get();

        $categories = Category::all();
       
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    
    public function show(Post $post)
    {
        $post->load('category', 'teams');

        return view('admin.posts.show', compact('post'));
    }
}