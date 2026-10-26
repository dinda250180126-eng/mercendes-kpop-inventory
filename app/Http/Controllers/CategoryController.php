<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        if (auth()->user()->role === 'staff') {
            abort(403, 'Aksi ini tidak diizinkan untuk Staff.');
        }

        return view('categories.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role === 'staff') {
            abort(403, 'Aksi ini tidak diizinkan untuk Staff.');
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Kategori ini sudah ada di dalam sistem.',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        if (auth()->user()->role === 'staff') {
            abort(403, 'Aksi ini tidak diizinkan untuk Staff.');
        }

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        if (auth()->user()->role === 'staff') {
            abort(403, 'Aksi ini tidak diizinkan untuk Staff.');
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Kategori ini sudah ada di dalam sistem.'
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description ?? $category->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Data kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        if (auth()->user()->role === 'staff') {
            abort(403, 'Aksi ini tidak diizinkan untuk Staff.');
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}