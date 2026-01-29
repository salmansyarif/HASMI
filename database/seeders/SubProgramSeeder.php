<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramCategory;
use App\Models\SubProgramCategory;

class SubProgramSeeder extends Seeder
{
    public function run()
    {
        $hasmiPeduli = ProgramCategory::where('slug', 'hasmi-peduli')->first();

        if ($hasmiPeduli) {
            $subcategories = [
                [
                    'name' => 'Tebar Pangan',
                    'slug' => 'tebar-pangan',
                    'sort_order' => 1
                ],
                [
                    'name' => "Tebar Al-Qur'an",
                    'slug' => 'tebar-al-quran',
                    'sort_order' => 2
                ],
                [
                    'name' => 'Tanggap Bencana',
                    'slug' => 'tanggap-bencana',
                    'sort_order' => 3
                ],
                [
                    'name' => 'Program Ambulance HASMI',
                    'slug' => 'ambulance-hasmi',
                    'sort_order' => 4
                ],
            ];

            foreach ($subcategories as $sub) {
                SubProgramCategory::create([
                    'program_category_id' => $hasmiPeduli->id,
                    'name' => $sub['name'],
                    'slug' => $sub['slug'],
                    'sort_order' => $sub['sort_order'],
                ]);
            }
        }
    }
}