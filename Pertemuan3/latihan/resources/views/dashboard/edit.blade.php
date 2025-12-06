<x-dashboard-layout>
    <x-slot:title>Edit Post</x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Post</h1>

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
            <x-posts.form :categories="$categories" :post="$post" />
        </div>
    </div>
</x-dashboard-layout>
