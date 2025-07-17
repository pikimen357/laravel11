<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @php
        $isActive = true;
        $hasError = false;
    @endphp

    <span @class([
        'p-4',
        'fw-bold' => $isActive,
        'text-success' => $is_admin,
        'bg-danger' => $hasError,
    ])>WKWKWKW</span>

    {{-- get $menu from public view (AppServiceProvider) --}}
    @if(isset($menu))
        <ul>
            @foreach($menu as $key => $value)
                <li><a href="{{ $value }}">{{ $key }}</a></li>
            @endforeach
        </ul>
    @endif

    <h1>{{ $titlePage }}</h1>

    {{-- Debug info (hapus di production) --}}
    @if(config('app.debug'))
        <pre>{{ print_r($movies, true) }}</pre>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
