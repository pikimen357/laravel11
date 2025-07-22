<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Action',
            'Adventure',
            'Comedy',
            'Drama',
            'Fantasy',
            'Horror',
            'Romance',
            'Science Fiction',
            'Thriller',
            'Western',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'title' => $category,
                'slug' => Str::of($category)->slug('-'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
