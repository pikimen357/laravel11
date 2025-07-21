<x-app>

    {{--  sidebar from $sidebar part & variable at app --}}
    <x-slot name="sidebar">
        {{-- Sending $menus data using :menus from router/controller to sidebar --}}
        <x-partials.sidebar :menus="[
            ['name' => 'Dashboard', 'link' => '/dashboard'],
            ['name' => 'Profile', 'link' => '/profile'],
            ['name' => 'Logout', 'link' => '/logout'],
            ['name' => 'Settings', 'link' => '/settings'],
            ['name' => 'Pricing', 'link' => '/pricing'],
        ]"></x-partials.sidebar>
    </x-slot>

        {{--  for convenience, use $main from main app --}}
        <x-slot name="main">

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-5">
                @foreach($movies as $movie)

                    <x-movie.card
                        :index="$loop->index"
                        :title="$movie['title']"
                        :image="$movie['image']"
                        :releasedate="$movie['release_date']">

                    </x-movie.card>

                @endforeach
            </div>


        </x-slot>

</x-app>
