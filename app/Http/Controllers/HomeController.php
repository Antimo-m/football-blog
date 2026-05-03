<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = ['News', 'Analisi', 'Calciomercato'];

        $posts = [];

        foreach ($categories as $category) {
            $posts[strtolower($category)] = Post::whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            })->latest()->first();
        }

        return view('welcome', [
            'newsPost' => $posts['news'],
            'analisiPost' => $posts['analisi'],
            'calciomercatoPost' => $posts['calciomercato'],
        ]);
    }
}
