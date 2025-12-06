<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query();

        // Cek apakah ada pencarian?
        if (request('search')) {
            $categories->where('name', 'like', '%' . request('search') . '%');
        }

        // Ambil datanya (get)
        return view('dashboard.categories.index', [
            'categories' => $categories->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Name saja (Hapus validasi slug)
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        // 2. Simpan (Otomatis hanya menyimpan name)
        Category::create($validatedData);

        return redirect()->route('dashboard.categories.index')->with('success', 'New category added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // 1. Validasi Name
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        // 2. Update data
        $category->update($validatedData);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return redirect()->route('dashboard.categories.index')->with('success', 'Category has been deleted!');
    }
}
