<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $restaurants = Restaurant::all();

        // Tant Bakiza
        $tantBakiza = $restaurants->where('name', 'Tant Bakiza')->first();

        if (!$tantBakiza) {
            return; // Exit if restaurant not found
        }

        Product::create([
            'restaurant_id' => $tantBakiza->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'بسبوسة',
            'description' => 'بسبوسة مصرية أصيلة، سادة طرية طعمها يجنن من غير أي اضافات',
            'price' => 79.00,
            'image' => 'menu/basbosa.png', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $tantBakiza->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'كنافة',
            'description' => 'كنافة بالفستق والقشطة البلدي > حلوة وجميلة ومقرمشة ومعمولة بالسمنة البلدي > محشية فستق وقشظة بلدي طازة وعليها شربات تقيل مظبوط بيدوب في القلب قبل البق',
            'price' => 109.00,
            'image' => 'menu/konafa.png', // ضع هنا مسار الصورة مثل: 'images/konafa.jpg'
            'sort_order' => 2,
        ]);

        Product::create([
            'restaurant_id' => $tantBakiza->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'كحك',
            'description' => 'كحك مصري بوصفة بكيزة اللي مايختلفش عليها اتنين <<< يدوب في البق ومن اول قطمة هاتعمل معاكم ذكري مش هاتنسوها طول العمر',
            'price' => 123.00,
            'image' => 'menu/kahk.png', // ضع هنا مسار الصورة مثل: 'images/kahk.jpg'
            'sort_order' => 3,
        ]);

        Product::create([
            'restaurant_id' => $tantBakiza->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'رز بلبن',
            'description' => 'زي مابتحبوه معمول علي طريقة طنط بكيزة <<< ناعم وسكره موزون ومن اول معلقة هادوق الرز بلبن بتاع زمان',
            'price' => 9.00,
            'image' => 'menu/roz1.png', // ضع هنا مسار الصورة مثل: 'images/roz-bel-laban.jpg'
            'sort_order' => 4,
        ]);

        Product::create([
            'restaurant_id' => $tantBakiza->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'رز بلبن (3 حبات)',
            'description' => '3 حبات ليك ولكل حبايبك علشان تكمل الفرحة وتشاركهم جمال الطعم',
            'price' => 25.00,
            'image' => 'menu/roz2.png', // ضع هنا مسار الصورة مثل: 'images/roz-bel-laban-3.jpg'
            'sort_order' => 5,
        ]);
    }
}
