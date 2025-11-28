<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <nav class="bg-blue-600 p-4 text-white">
        <a href="/" class="mr-4 hover:underline">Home</a>
        <a href="/about" class="mr-4 hover:underline">About</a>
        <a href="/posts" class="mr-4 hover:underline">Blog</a>
        <a href="/categories" class="mr-4 hover:underline">Categories</a>
        <a href="/contact" class="mr-4 hover:underline">Contact</a>
    </nav>

    <main class="p-8 flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-gray-800 text-white p-4 text-center mb-0">
        <p>Copyright &copy; 2025</p>
    </footer>
</body>

</html>
