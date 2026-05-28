<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard', [
            'postsCount' => \App\Models\Post::count(),
            'categoriesCount' => \App\Models\Category::count(),
            'teamsCount' => \App\Models\Team::count(),
            'usersCount' => \App\Models\User::count(),
            'recentPosts' => \App\Models\Post::with('category', 'teams')
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    }
}
