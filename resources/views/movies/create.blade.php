@extends('app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-6">Add Movie</h2>

        <form class="space-y-6" action="{{ route('movie.store') }}" method="POST">
            @csrf

            {{-- Title --}}
            <div>
                <label for="title" class="block text-lg mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="w-full p-2 bg-gray-800 border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-lg mb-2">Description</label>
                <textarea name="description" id="description"
                    class="w-full p-2 bg-gray-800 border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Release Date --}}
            <div>
                <label for="release_date" class="block text-lg mb-2">Release Date</label>
                <input type="date" name="release_date" id="release_date" value="{{ old('release_date') }}"
                    class="w-full p-2 bg-gray-800 border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 @error('release_date') border-red-500 @enderror">
                @error('release_date')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Cast --}}
            <div>
                <label for="cast" class="block text-lg mb-2">Cast</label>
                <input type="text" name="cast" id="cast" value="{{ old('cast') }}"
                    class="w-full p-2 bg-gray-800 border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 @error('cast') border-red-500 @enderror">
                @error('cast')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Genres --}}
            <div>
                <label for="genres" class="block text-lg mb-2">Genres</label>
                <input type="text" name="genres" id="genres" value="{{ old('genres') }}"
                    class="w-full p-2 bg-gray-800 border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 @error('genres') border-red-500 @enderror">
                @error('genres')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Poster --}}
            <div>
                <label for="image" class="block text-lg mb-2">Poster</label>
                <input type="text" name="image" id="image" value="{{ old('image') }}"
                    class="w-full p-2 bg-gray-800 border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 @error('image') border-red-500 @enderror">
                @error('image')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit" class="bg-blue-600 px-6 py-2 rounded hover:bg-blue-500">Save</button>
            </div>
        </form>
    </div>
@endsection
