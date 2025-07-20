{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <title>Movie Index</title>--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">--}}
{{--</head>--}}
{{--<body>--}}
{{--    @php--}}
{{--        $isActive = true;--}}
{{--        $hasError = false;--}}
{{--    @endphp--}}

{{--    <span @class([--}}
{{--        'p-4',--}}
{{--        'fw-bold' => $isActive,--}}
{{--        'text-success' => $is_admin,--}}
{{--        'text-danger' => ! $is_admin,--}}
{{--        'bg-danger' => $hasError,--}}
{{--    ])>PAGE</span>--}}

{{--    --}}{{-- get $menu from public view (AppServiceProvider) --}}
{{--    @if(isset($menu))--}}
{{--        <ul>--}}
{{--            @foreach($menu as $key => $value)--}}
{{--                <li><a href="{{ $value }}">{{ $key }}</a></li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    @endif--}}

{{--    <h1>{{ $titlePage }}</h1>--}}

{{--    --}}{{-- Debug info (hapus di production) --}}
{{--    @if(config('app.debug'))--}}
{{--        <pre>{{ print_r($movies, true) }}</pre>--}}
{{--    @endif--}}

{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>--}}
{{--</body>--}}
{{--</html>--}}

@extends('app')

@section('content')

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-5">

        @foreach($movies as $movie)

            {{-- link to movie details with index  --}}
                <div class="bg-gray-800 p-4 rounded-lg relative group">
                    <a href="{{ route('movie.show', $loop->index) }}">
                        <img src="{{ $movie['image'] }}" alt="{{ $movie['title'] }}" class="rounded-md w-full">
                        <h3 src="text-lg mt-2">{{ $movie['title'] }}</h3>
                        <p src="text-sm text-gray-400">{{ $movie['release_date'] }}</p>

                        <div class="absolute top-2 right-2 space-x-2 opacity-0 group-hover:opacity-100 transition">
                            <a href="{{ route('movie.edit', $loop->index) }}"
                                class="bg-green-600 p-1 rounded hover:bg-green-500">
                                ✏️
                            </a>
                            <form id="delete-form-{{ $loop->index }}" action="{{ route('movie.destroy', $loop->index) }}"
                                  style="display: none" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="{{ route('movie.destroy', $loop->index) }}"
                               onclick="event.preventDefault(); confirm('Are You Sure?'); document.getElementById('delete-form-{{ $loop->index }}').submit();"
                               class="bg-red-600 p-1 rounded hover:bg-red-500">
                                🗑️
                            </a>

                        </div>
                    </a>
                </div>
        @endforeach

    </div>

@endsection
