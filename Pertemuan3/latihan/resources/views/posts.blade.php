<x-layout>
    <x-slot:title>Daftar Post</x-slot:title>

    <h1 class="text-3xl font-bold mb-6 text-gray-900">Daftar Posts</h1>

    @foreach ($posts as $post)
        <article class="mb-5 border-b border-gray-200 pb-5">
            <h2 class="text-2xl font-bold mb-1">
                <a href="/posts/{{ $post->slug }}" class="text-blue-600 hover:underline">
                    {{ $post->title }}
                </a>
            </h2>
            <div class="text-gray-500 text-sm mb-2">
                By <a href="#" class="hover:underline text-gray-700">{{ $post->author->name }}</a> 
                in <a href="#" class="hover:underline text-gray-700">{{ $post->category->name }}</a>
            </div>
            <p class="text-gray-700">{{ $post->excerpt }}</p>
            <a href="/posts/{{ $post->slug }}" class="text-sm text-blue-500 hover:underline">Read more &raquo;</a>
        </article>
    @endforeach

</x-layout>