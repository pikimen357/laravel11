<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = DB::table('movies')->pluck('id')->toArray();

        $users = DB::table('users')->pluck('id')->toArray();

        $ratings = [];

        foreach ($movies as $movie) {
            foreach ($users as $user) {
                $ratings[] = [
                    'movie_id' => $movie,
                    'user_id' => $user,
                    'rating' => rand(1, 5),
                ];
            }
        }

        DB::table('ratings')->insert($ratings);

    }
}
