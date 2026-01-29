<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategorySeeder extends Seeder
{
    public function run()
    {
        // Ambil category Pernikahan
        $pernikahan = Category::where('slug', 'pernikahan')->first();

        if ($pernikahan) {
            $subCategories = [
                ['name' => 'Keluarga', 'slug' => 'keluarga', 'icon' => 'fa-users', 'order' => 1],
                ['name' => 'Fiqih Muslimah', 'slug' => 'fiqih-muslimah', 'icon' => 'fa-book', 'order' => 2],
                ['name' => 'Kisah Muslimah', 'slug' => 'kisah-muslimah', 'icon' => 'fa-book-reader', 'order' => 3],
                ['name' => 'Muslimah Shalehah', 'slug' => 'muslimah-shalehah', 'icon' => 'fa-female', 'order' => 4],
                ['name' => 'Nasihat Anda', 'slug' => 'nasihat-anda', 'icon' => 'fa-comment-dots', 'order' => 5],
                ['name' => 'Serba serbi Muslimah', 'slug' => 'serba-serbi-muslimah', 'icon' => 'fa-list', 'order' => 6],
            ];

            foreach ($subCategories as $subCategory) {
                SubCategory::create([
                    'category_id' => $pernikahan->id,
                    'name' => $subCategory['name'],
                    'slug' => $subCategory['slug'],
                    'icon' => $subCategory['icon'],
                    'order' => $subCategory['order'],
                ]);
            }
        }
    }
}