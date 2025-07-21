<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie App</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-900 text-white">
    <x-partials.header></x-partials.header>

    <div class="min-h-screen flex mb-20">
        <aside class="w-60 bg-gray-700 p-6 text-white">
            {{ $sidebar }}
        </aside>

        <main class="flex-1 p-6 bg-gray-900">
            {{ $main }}
        </main>
    </div>

    <x-partials.footer></x-partials.footer>

</body>
</html>
