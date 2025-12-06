<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id);

        // Fitur Pencarian
        if (request('search')) {
            $posts->where('title', 'like', '%' . request('search') . '%');
        }

        // Menampilkan 5 data per halaman dengan pagination
        return view('dashboard.index', [
            'posts' => $posts->paginate(5)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Generate slug dari title
        $slug = Str::slug($request->title);

        // Validasi input dengan custom messages
        $validator = Validator::make($request->all(), [
            'title'       => 'required|max:255',
            'category_id' => 'required|exists:categories,id', // Pastikan ID ada di tabel categories
            'excerpt'     => 'required',
            'body'        => 'required',
            // Aturan gambar: boleh kosong (nullable), harus image, format tertentu, max 2MB
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            // Custom Messages (Pesan Error Bahasa Indonesia)
            'title.required'       => 'Field Title wajib diisi',
            'title.max'            => 'Field Title tidak boleh lebih dari 255 karakter',
            'category_id.required' => 'Field Category wajib dipilih',
            'category_id.exists'   => 'Category yang dipilih tidak valid',
            'excerpt.required'     => 'Field Excerpt wajib diisi',
            'body.required'        => 'Field Content wajib diisi',
            'image.image'          => 'File harus berupa gambar',
            'image.mimes'          => 'Format gambar harus jpeg, png, jpg, atau gif',
            'image.max'            => 'Ukuran gambar maksimal 2MB',
        ]);

        // Jika validasi gagal, kembalikan user ke form dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // Mengembalikan data yang sudah diketik user
        }

        // Generate slug dari title
        $slug = Str::slug($request->title);

        // Pastikan slug unique - jika sudah ada, tambahkan angka di belakang
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Handle image upload
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post-images', 'public');
        }

        // Create post
        Post::create([
            'title'       => $request->title,
            'slug'        => $slug,
            'category_id' => $request->category_id,
            'excerpt'     => $request->excerpt,
            'body'        => $request->body,
            'image'       => $imagePath, // Simpan path gambar (contoh: 'post-images/filename.jpg')
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Cek Policy 'update'
        Gate::authorize('update', $post);

        return view('dashboard.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Cek Policy 'update'
        Gate::authorize('update', $post);
        // 1. Validasi
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'nullable|image|max:2048',
            'body' => 'required',
            'excerpt' => 'required'
        ];

        if ($request->title != $post->title) {
            $rules['slug'] = 'unique:posts';
        }

        $validatedData = $request->validate($rules);

        // 2. Slug Baru (Jika title berubah)
        if ($request->title != $post->title) {
            $validatedData['slug'] = \Illuminate\Support\Str::slug($request->title);
        }

        // 3. Gambar
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            // Simpan gambar baru ke folder 'public' (INI YANG KURANG SEBELUMNYA)
            $validatedData['image'] = $request->file('image')->store('post-images', 'public');
        }

        $validatedData['user_id'] = auth()->user()->id;

        // 4. Update
        Post::where('id', $post->id)->update($validatedData);

        // 5. Redirect menggunakan Route Name
        return redirect()->route('dashboard.index')->with('success', 'Data Berhasil Di Perbarui!!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Cek Policy 'delete'
        Gate::authorize('delete', $post);

        if ($post->image) {
            // Storage::delete($post->image);
            Storage::disk('public')->delete($post->image);
        }

        Post::destroy($post->id);

        // GUNAKAN ROUTE NAME AGAR AMAN & KONSISTEN
        return redirect()->route('dashboard.index')->with('success', 'Data Berhasil Di hapus!');
    }
}
