<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'วิชาการ',
            'ICT',
            'ภาษา',
            'การวัดและประเมินผล',
            'การบริหารจัดการ',
            'ศิลปะและดนตรี',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
