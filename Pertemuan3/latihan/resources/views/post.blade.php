<x-layout>
    <x-slot:title>{{ $post->title }}</x-slot:title>


    <article class="mb-5 border-b border-gray-200 pb-5">
        <h2 class="text-2xl font-bold mb-1 tracking-tight text-gray-900">
            {{ $post->title }}
        </h2>

        <div class="text-gray-500 text-sm mb-2">
            By
            <a href="#" class="hover:underline text-base text-gray-500">{{ $post->author->name }}</a>
            in
            <a href="#" class="hover:underline text-base text-gray-500">{{ $post->category->name }}</a>
            | {{ $post->created_at->diffForHumans() }}
        </div>

        @if ($post->image)
            <div style="max-height: 400px; overflow:hidden;">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                    class="w-full h-[400px] object-cover rounded-xl mt-4 mb-6">
            </div>
        @endif

        <p class="my-4 font-light">{{ $post->body }}</p>

        <a href="/posts" class="text-sm text-blue-500 hover:underline">&laquo; Back to posts</a>
    </article>

</x-layout>
