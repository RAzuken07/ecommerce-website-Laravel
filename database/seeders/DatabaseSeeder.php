<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Memanggil UserSeeder untuk memasukkan data pengguna
        $this->call([
            UserSeeder::class,  // Menambahkan UserSeeder
            ProductSeeder::class, // Menambahkan ProductSeeder
        ]);
    }
}