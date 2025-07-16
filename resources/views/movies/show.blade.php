<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie Show</title>
</head>
<body>


        {{-- get $menu from public view (AppServiceProvider)  --}}
        <ul>
            <?php foreach ($menu as $key => $value): ?>
                <li><a href="<?php $value ?>"><?= $key ?></a></li>
            <?php endforeach; ?>
        </ul>

    <h1>{{ $titlePage }} : {{ $idMovie }}</h1>
    <p>{{  print_r($movie) }}</p>
</body>
</html>
