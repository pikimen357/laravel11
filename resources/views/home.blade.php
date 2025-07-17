<?php

    $greeting = 'Hello everybody, I hope you fine';

?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>

        {{-- get $menu from public view (AppServiceProvider)  --}}
{{--        <ul>--}}
{{--            <?php foreach ($menu as $key => $value): ?>--}}
{{--                <li><a href="<?php $value ?>"><?= $key ?></a></li>--}}
{{--            <?php endforeach; ?>--}}
{{--        </ul>--}}

        <h1>Home Page</h1>

        <h5>FOREACH</h5>
        <ul>
                @foreach ($movies as $movie)
{{--                    @if($movie['year'] > 2011)--}}
{{--                        @continue--}}
{{--                    @endif--}}
{{--                    @if($movie['year'] < 2000)--}}
{{--                        @break--}}
{{--                    @endif--}}
{{--                    <li>--}}
{{--                        {{ $movie['title'] }} : {{ $movie['year'] }}--}}
{{--                    </li>--}}

{{--                    @if($loop->first)--}}
{{--                        <li>First Movie : {{ $movie['title'] }} - {{ $movie['year'] }}</li>--}}
{{--                    @elseif($loop->last)--}}
{{--                        <li>Last Movie : {{ $movie['title'] }} - {{ $movie['year'] }}</li>--}}
{{--                    @endif--}}

{{--                <p>Movie {{ $loop->iteration }} of {{ $loop->count }} : {{ $movie['title'] }} - {{ $movie['year'] }}</p>--}}

{{--                    <p class="{{ $movie['year'] < 2000 ? 'text-red-500' : 'text-green-500' }}">--}}
{{--                    <p class="{{ $loop->first ? 'font-bold' : ( $loop->last ? 'italic' : '') }}">--}}
{{--                        {{ $movie['title'] }} - {{ $movie['year'] }}--}}
{{--                    </p>--}}

                    @include('partials._movie', ['movie' => $movie])

                @endforeach
        </ul>

{{--        <h5>FOR</h5>--}}
{{--       <ul>--}}
{{--            @for($index = 0; $index < count($movies); $index ++)--}}
{{--                <li>{{ $movies[$index]['title'] }} {{ $movies[$index]['year'] }}</li>--}}
{{--            @endfor--}}
{{--        </ul>--}}

{{--        <h5>FORELSE</h5>--}}
{{--         <ul>--}}
{{--            @forelse ($movies as $movie)--}}
{{--                <li>{{ $movie['title'] }} - {{ $movie['year'] }}</li>--}}
{{--            @empty--}}
{{--                <p>No Movies</p>--}}
{{--            @endforelse--}}
{{--        </ul>--}}

{{--        <h5>WHILE</h5>--}}
{{--        <ul>--}}
{{--            @php--}}
{{--                $index = 0--}}
{{--            @endphp--}}

{{--            @while($index < count($movies))--}}
{{--                <li>{{ $movies[$index]['title'] }} - {{ $movies[$index]['year'] }}</li>--}}
{{--                @php--}}
{{--                    $index++;--}}
{{--                @endphp--}}
{{--            @endwhile--}}
{{--        </ul>--}}

{{--        <h2>Movie Category</h2>--}}

{{--        @switch($movieCategory)--}}
{{--            @case('action')--}}
{{--                <h4>Action Movie</h4>--}}
{{--                @break--}}

{{--            @case('comedy')--}}
{{--                <h4>Comedy Movie</h4>--}}
{{--                @break--}}

{{--            @default--}}
{{--                <h4>Other Movie</h4>--}}
{{--        @endswitch--}}

{{--        <p>{{ $greeting }}</p>--}}
{{--        <p>{{ $name }}</p>--}}

{{--        User:--}}
{{--        <ul>--}}
{{--            <li>Name: {{ $user['name'] }}</li>--}}
{{--            <li>Email: {{ $user['email'] }}</li>--}}
{{--            @if($user['role'] == 'admin')--}}
{{--                <li>Role: Admin</li>--}}
{{--            @elseif($user['role' ] == 'user')--}}
{{--                <li>Role: User</li>--}}
{{--            @else--}}
{{--                <li>Role: Unknown</li>--}}
{{--            @endif--}}
{{--            <li>Role: {{--}}
{{--                $user['role'] == 'admin' ? "Administrator" :--}}
{{--                ($user['role'] == 'user' ? 'User' : 'Unknown')--}}
{{--            }}</li>--}}
{{--        </ul>--}}

    </body>
    <script>

        // movies from HomeController that is converted to JSON javascript
        var app = {{ Js::from($user) }};
        console.log(app);
    </script>
</html>
