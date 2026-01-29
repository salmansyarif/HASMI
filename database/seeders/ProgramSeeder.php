<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramCategory;

class ProgramSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Program HASMI',
                'slug' => 'program-hasmi',
                'has_subcategories' => false,
                'is_creatable' => false,
                'redirect_type' => 'static',
                'redirect_url' => '/program-hasmi',
                'sort_order' => 1,
            ],
            [
                'name' => 'HASMI Peduli',
                'slug' => 'hasmi-peduli',
                'has_subcategories' => true,
                'is_creatable' => true,
                'redirect_type' => null,
                'redirect_url' => null,
                'sort_order' => 2,
            ],
            [
                'name' => 'Program Dakwah',
                'slug' => 'program-dakwah',
                'has_subcategories' => false,
                'is_creatable' => true,
                'redirect_type' => null,
                'redirect_url' => null,
                'sort_order' => 3,
            ],
            [
                'name' => 'Program Pendidikan',
                'slug' => 'program-pendidikan',
                'has_subcategories' => false,
                'is_creatable' => true,
                'redirect_type' => null,
                'redirect_url' => null,
                'sort_order' => 4,
            ],
            [
                'name' => 'HASMI TV',
                'slug' => 'hasmi-tv',
                'has_subcategories' => false,
                'is_creatable' => false,
                'redirect_type' => 'youtube',
                'redirect_url' => 'https://www.youtube.com/@HASMI',
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            ProgramCategory::create($category);
        }
    }
}