<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Aulia Rahman', 'email' => 'aulia.rahman@example.com'],
            ['name' => 'Siti Nurhaliza', 'email' => 'siti.nurhaliza@example.com'],
        ];

        foreach ($users as $user) {
            User::factory()->create($user);
        }
    }
}
