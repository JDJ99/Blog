<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Limit the seed to 10 times
        for ($i = 0; $i < 10; $i++) {
            $this->call(DatabaseSeeder::class);
        }
    }
}