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
        // Buat user admin dulu
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'), // Gunakan bcrypt untuk hash password
                'email_verified_at' => now(),
            ]
        );

        // Panggil seeder lainnya
        $this->call([
            CategorySeeder::class,
            ProgramSeeder::class,
            SubCategorySeeder::class,
            SubProgramSeeder::class,
        ]);
    }
}