<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => bcrypt('qwerty123'),
            'role' => 'admin'
        ]);


        User::create([
            'name' => 'pimpinan',
            'email' => 'pimpinan@gmail.com',
            'username' => 'pimpinan',
            'password' => bcrypt('qwerty123'),
            'role' => 'pimpinan'
        ]);
    }
}
