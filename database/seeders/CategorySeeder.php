<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Wawasan Islam', 'slug' => 'wawasan-islam', 'description' => 'Wawasan dan pemahaman Islam kontemporer', 'icon' => 'fa-lightbulb'],
            ['name' => 'Rubrik Kisah', 'slug' => 'rubrik-kisah', 'description' => 'Kisah inspiratif dan teladan', 'icon' => 'fa-book-open'],
            ['name' => 'Khutbah Jumat', 'slug' => 'khutbah-jumat', 'description' => 'Kumpulan khutbah Jumat pilihan', 'icon' => 'fa-mosque'],
            ['name' => 'Konsultasi', 'slug' => 'konsultasi', 'description' => 'Tanya jawab seputar Islam', 'icon' => 'fa-comments'],
            ['name' => 'Akidah', 'slug' => 'akidah', 'description' => 'Pemahaman akidah yang benar', 'icon' => 'fa-star-and-crescent'],
            ['name' => 'Manhaj', 'slug' => 'manhaj', 'description' => 'Manhaj salafush shalih', 'icon' => 'fa-route'],
            ['name' => 'Fiqih & Muamalah', 'slug' => 'fiqih-muamalah', 'description' => 'Hukum Islam dan transaksi', 'icon' => 'fa-balance-scale'],
            ['name' => 'Syarah Hadist', 'slug' => 'syarah-hadist', 'description' => 'Penjelasan hadist-hadist pilihan', 'icon' => 'fa-scroll'],
            ['name' => 'Tafsir Ringkas', 'slug' => 'tafsir-ringkas', 'description' => 'Tafsir Al-Quran ringkas', 'icon' => 'fa-quran'],
            ['name' => 'Robbaniyah', 'slug' => 'robbaniyah', 'description' => 'Pembinaan ruhani dan spiritual', 'icon' => 'fa-pray'],
            ['name' => ' Pernik Muslimah', 'slug' => 'pernikahan', 'description' => 'Panduan pernikahan Islami', 'icon' => 'fa-heart'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}