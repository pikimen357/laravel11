<?php

    $greeting = 'Hello everybody, I hope you fine';

?>

<html lang="en">
    <head>
        <title>Home</title>
    </head>
    <body>

        {{-- get $menu from public view (AppServiceProvider)  --}}
        <ul>
            <?php foreach ($menu as $key => $value): ?>
                <li><a href="<?php $value ?>"><?= $key ?></a></li>
            <?php endforeach; ?>
        </ul>

        <h1>Home Page</h1>
        <p>{{ $greeting }}</p>
    </body>
</html>
