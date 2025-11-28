<x-layout>
    <x-slot:title>Categories</x-slot:title>

    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-900">Daftar Kategori</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($categories as $category)
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold mb-2">
                        {{ $category->name }}
                    </h2>
                    <a href="/posts?category={{ $category->slug }}" class="text-blue-500 hover:underline">
                        Lihat Postingan &raquo;
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>