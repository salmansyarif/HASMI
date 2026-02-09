<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus user lama jika ada untuk memastikan bersih
        \App\Models\User::where('email', 'hasmi@gmail.com')->delete();

        // Buat user baru tanpa bcrypt manual karena model User sudah otomatis handling hash
        \App\Models\User::create([
            'name'              => 'Administrator',
            'email'             => 'hasmi@gmail.com',
            'password'          => 'admin123', // JANGAN PAKAI BCRYPT DISINI
            'email_verified_at' => now(),
        ]);
    }
}
