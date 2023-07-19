<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        // make user for admin
        \App\Models\User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("password"),
            "roles" => "ADMIN",
        ]);

        // buat 4 data category tentang tanaman
        \App\Models\Category::create([
            "name" => "Tanaman Hias",
        ]);

    }
}
