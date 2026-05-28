<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
        /* return view('admin.categories.index', compact('categories')); */
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50'
        ]);

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoria creata con successo');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50'
        ]);

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoria aggiornata con successo');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoria eliminata con successo');
    }
}
