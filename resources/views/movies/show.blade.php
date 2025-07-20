@extends('app')

@section('content')
    <div class="flex flex-col md:flex-row items-start">
        <div class="w-full md:w-1/3">
            <img src="{{ $movie['image'] }}" alt="{{ $movie['title'] }}" class="rounded-lg shadow-lg">
        </div>
        <div class="md:ml-10 mt-5 md:mt-0 w-full md:w-2/3">
            <h2 class="text-4xl font-bold mb-4">{{ $movie['title'] }}</h2>
            <p class="text-gray-400 text-lg mb-4">
                Release Date: <span class="text-white">{{ $movie['release_date'] }}</span>
            </p>

            <p class="text-lg mb-4">{{ $movie['description'] }}</p>

            <h3 class="text-xl font-semibold mb-2">Cast</h3>
            <p class="text-gray-300 mb-4">
                @foreach($movie['cast'] as $cast)
                    {{ $cast }}
                @endforeach
            </p>

            <h3 class="text-xl font-semibold mb-2">Genres</h3>
            <p class="text-gray-300 mb-4">
                @foreach($movie['genres'] as $genre)
                    {{ $genre }}
                @endforeach
            </p>

            <div class="flex space-x-4 mt-5">

                <a href="{{ route('movie.edit', $idMovie) }}"
                   class="bg-green-600 p-1 rounded hover:bg-green-500">
                    ✏️
                </a>

                <form id="delete-form-{{ $idMovie }}" action="{{ route('movie.destroy', $idMovie) }}"
                      style="display: none" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
                <a href="{{ route('movie.destroy', $idMovie) }}"
                   onclick="event.preventDefault(); confirm('Are You Sure?'); document.getElementById('delete-form-{{ $idMovie }}').submit();"
                   class="bg-red-600 p-1 rounded hover:bg-red-500">
                                🗑️
                </a>

            </div>
        </div>
    </div>
@endsection
