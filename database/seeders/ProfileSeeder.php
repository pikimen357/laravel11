<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //  Using the relationship method (more elegant)
        User::factory(3)->create()->each(function ($user) {
            $user->profile()->create([
                'phone' => '08' . fake()->numerify('##########'),
                'address' => fake()->address(),
            ]);
        });
    }
}
