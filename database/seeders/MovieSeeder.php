<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            ['title' => 'Inception', 'slug' => 'inception'],
            ['title' => 'Pulp Fiction', 'slug' => 'pulp-fiction'],
            ['title' => 'The Silence of the Lambs', 'slug' => 'the-silence-of-the-lambs'],
            ['title' => 'Forrest Gump', 'slug' => 'forrest-gump'],
            ['title' => 'Fight Club', 'slug' => 'fight-club'],
        ];

        DB::table('movies')->insert(array_map(function ($movie) {
            return array_merge($movie,[
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }, $movies));
    }
}
