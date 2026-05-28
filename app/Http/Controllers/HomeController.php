<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('latestPost')->get();

        $postsCount = Post::count();

        return view('welcome', compact(
            'categories',
            'postsCount'
        ));
    }
};