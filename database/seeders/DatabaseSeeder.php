<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder lainnya
        $this->call([
            AdminSeeder::class, // Admin seeder dipanggil pertama
            CategorySeeder::class,
            ProgramSeeder::class,
            SubCategorySeeder::class,
            SubProgramSeeder::class,
        ]);
    }
}