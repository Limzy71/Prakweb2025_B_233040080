@props(['categories', 'post' => null])

{{-- Form Body --}}
<form action="{{ $post ? route('dashboard.update', $post->slug) : route('dashboard.store') }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @if ($post)
        @method('PUT')
    @endif
    <div class="grid gap-4 grid-cols-2">
        {{-- Title --}}
        <div class="col-span-2">
            <label for="title" class="block mb-2.5 text-sm font-medium text-heading">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post?->title) }}"
                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                placeholder="Enter post title">

            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Category --}}
        <div class="col-span-2">
            <label for="category_id" class="block mb-2.5 text-sm font-medium text-heading">Category</label>
            <select name="category_id" id="category_id"
                class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                <option value="">Select category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $post?->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Excerpt --}}
        <div class="col-span-2">
            <label for="excerpt" class="block mb-2.5 text-sm font-medium text-heading">Excerpt</label>
            <textarea name="excerpt" id="excerpt" rows="3"
                class="block bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand w-full p-3.5 shadow-xs placeholder:text-body"
                placeholder="Write a short excerpt or summary">{{ old('excerpt', $post?->excerpt) }}</textarea>

            @error('excerpt')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Body --}}
        <div class="col-span-2">
            <label for="body" class="block mb-2.5 text-sm font-medium text-heading">Content</label>
            <textarea name="body" id="body" rows="8"
                class="block bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand w-full p-3.5 shadow-xs placeholder:text-body"
                placeholder="Write your post content here">{{ old('body', $post?->body) }}</textarea>

            @error('body')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Image Upload --}}
        <div class="col-span-2">
            <label for="image" class="block mb-2.5 text-sm font-medium text-heading">Upload Image</label>

            {{-- TAMBAHAN: Tampilkan gambar lama jika ada --}}
            @if ($post?->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image"
                        class="h-32 w-auto object-cover rounded-lg border border-gray-300">
                    <p class="text-gray-950 mt-3">Gambar saat ini</p>
                </div>
            @endif

            <input type="file" name="image" id="image" accept="image/png, image/jpeg, image/jpg"
                class="cursor-pointer bg-neutral-secondary-medium border text-sm rounded-base focus:ring-brand focus:border-brand block w-full shadow-xs placeholder:text-body
        @error('image') border-red-500 text-red-900 @else border-default-medium text-heading @enderror">

            @error('image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Form Footer --}}
        <div class="flex items-center space-x-4 border-t border-default pt-4 md:pt-6 mt-4 md:mt-6">
            <button type="submit"
                class="inline-flex items-center text-white bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                {{ $post ? 'Update Post' : 'Create Post' }}
            </button>
            <a href="{{ route('dashboard.index') }}"
                class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                Cancel
            </a>
        </div>
    </div>
</form>
