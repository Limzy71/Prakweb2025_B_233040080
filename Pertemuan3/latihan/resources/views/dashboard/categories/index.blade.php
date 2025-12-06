<x-dashboard-layout>
    <x-slot:title>Post Categories</x-slot:title>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6 px-4 sm:px-0">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome, {{ auth()->user()->name }}</h1>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">

                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                        <div class="w-full sm:w-1/3">
                            <form action="{{ route('dashboard.categories.index') }}" method="GET">
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </span>

                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Search categories...">
                                </div>
                            </form>
                        </div>

                        <a href="{{ route('dashboard.categories.create') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 transition duration-150 ease-in-out">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Category
                        </a>
                    </div>

                    @if (session()->has('success'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                            role="alert">
                            <span class="font-medium">Success!</span> {{ session('success') }}
                        </div>
                    @endif

                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 w-16">#</th>
                                    <th scope="col" class="px-6 py-3">Category Name</th>
                                    <th scope="col" class="px-6 py-3 text-center w-48">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ $category->name }}</td>

                                        <td class="px-6 py-4 text-center">
                                            <div class="flex items-center justify-center space-x-3">

                                                <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                                    class="font-medium text-yellow-500 hover:text-yellow-600 hover:underline transition duration-150">
                                                    Edit
                                                </a>

                                                <span class="text-gray-300">|</span>

                                                <form
                                                    action="{{ route('dashboard.categories.destroy', $category->id) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="font-medium text-red-600 hover:text-red-700 hover:underline transition duration-150"
                                                        onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
