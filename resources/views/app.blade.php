<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie App</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-900 text-white">
    @include('_partials._header')

    <div class="container mx-auto p-5">
        @yield('content')
    </div>

{{--    <div class="border-t border-b border-gray-200 text-white">--}}
{{--        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">--}}
{{--            <h1 class="text-4xl font-bold text-center">Welcome to laravel 11</h1>--}}
{{--            <p class="text-xl text-center mt-6">This is a simple example of laravel 11</p>--}}
{{--        </div>--}}
{{--    </div>--}}

</body>
</html>
