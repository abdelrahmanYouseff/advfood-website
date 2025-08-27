<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'الوجبات الرئيسية',
                'description' => 'أشهى الوجبات الرئيسية من مختلف المطابخ العالمية',
                'sort_order' => 1,
            ],
            [
                'name' => 'المقبلات',
                'description' => 'مقبلات شهية لبدء وجبتك',
                'sort_order' => 2,
            ],
            [
                'name' => 'السلطات',
                'description' => 'سلطات طازجة ومغذية',
                'sort_order' => 3,
            ],
            [
                'name' => 'المشروبات',
                'description' => 'مشروبات منعشة ومشروبات ساخنة',
                'sort_order' => 4,
            ],
            [
                'name' => 'الحلويات',
                'description' => 'حلويات شهية لإنهاء وجبتك',
                'sort_order' => 5,
            ],
            [
                'name' => 'الوجبات السريعة',
                'description' => 'وجبات سريعة ولذيذة',
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

