<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Team;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $teams = Team::all();

        return view('admin.posts.create', compact('categories', 'teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'writer' => 'required|string|max:255',
            'category_id' => 'required',
            'image' => 'nullable|image|max:2048',
            'teams' => 'required|array'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $teamIds = $data['teams'];
        unset($data['teams']);

        $post = Post::create($data);

        $post->teams()->sync($teamIds);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('category', 'teams');

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $teams = Team::all();

        return view('admin.posts.edit', compact('post', 'categories', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'writer' => 'required|string|max:255',
            'category_id' => 'required',
            'image' => 'nullable|image|max:2048',
            'teams' => 'required|array'
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $teamIds = $data['teams'];
        unset($data['teams']);

        $post->update($data);

        $post->teams()->sync($teamIds);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image) {

            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
