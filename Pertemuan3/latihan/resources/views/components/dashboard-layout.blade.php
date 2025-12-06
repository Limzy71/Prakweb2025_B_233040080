<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <nav class="bg-blue-600 p-4 text-white">
        <div class="max-w-screen-xl mx-auto flex justify-between items-center">
            {{-- Menu Utama --}}
            <div class="flex items-center gap-4">
                <a href="/" class="hover:underline hover:text-blue-200 transition">Home</a>
                <a href="/about" class="hover:underline hover:text-blue-200 transition">About</a>
                <a href="/posts" class="hover:underline hover:text-blue-200 transition">Blog</a>
                <a href="/categories" class="hover:underline hover:text-blue-200 transition">Categories</a>
                <a href="/contact" class="hover:underline hover:text-blue-200 transition">Contact</a>

                @auth
                    {{-- Jika User SUDAH Login --}}
                    {{-- Tombol Categories --}}
                    <a href="{{ route('dashboard.categories.index') }}"
                        class="hover:underline hover:text-blue-200 transition">
                        Categories
                    </a>

                    {{-- Tombol Dashboard --}}
                    <a href="{{ route('dashboard.index') }}" class="hover:underline hover:text-blue-200 transition">
                        Dashboard
                    </a>
                @endauth
            </div>

            {{-- Authentication (Login/Logout) --}}
            <div class="flex items-center gap-4">
                @auth
                    {{-- Tombol Logout (Dibuat Rapi) --}}
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm font-medium transition ml-2">
                            Logout
                        </button>
                    </form>
                @else
                    {{-- Jika User BELUM Login (Tamu) --}}
                    <a href="{{ route('login') }}" class="hover:underline hover:text-blue-200 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-white text-blue-600 hover:bg-gray-100 px-3 py-1 rounded-md text-sm font-medium transition">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="p-8 flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-gray-800 text-white p-4 text-center mb-0">
        <p>Copyright &copy; 2025</p>
    </footer>
</body>

</html>
