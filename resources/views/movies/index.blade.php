<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie Index</title>
</head>
<body>

        {{-- get $menu from public view (AppServiceProvider)  --}}
        <ul>
            <?php foreach ($menu as $key => $value): ?>
                <li><a href="<?php $value ?>"><?= $key ?></a></li>
            <?php endforeach; ?>
        </ul>

{{--        {{ dd($config) }}--}}

    <h1>{{ $titlePage }}</h1>
    <p>{{ dd($movies) }}</p>
</body>
</html>
