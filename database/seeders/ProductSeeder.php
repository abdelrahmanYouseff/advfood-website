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

        // مطعم الشرق الأوسط
        $middleEast = $restaurants->where('name', 'مطعم الشرق الأوسط')->first();

        Product::create([
            'restaurant_id' => $middleEast->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'كباب لحم مشوي',
            'description' => 'كباب لحم ضأن مشوي على الفحم مع الأرز والخضروات',
            'price' => 85.00,
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $middleEast->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'شاورما دجاج',
            'description' => 'شاورما دجاج مع الخبز العربي والصلصة الخاصة',
            'price' => 45.00,
            'sort_order' => 2,
        ]);

        Product::create([
            'restaurant_id' => $middleEast->id,
            'category_id' => $categories->where('name', 'المقبلات')->first()->id,
            'name' => 'حمص بالطحينة',
            'description' => 'حمص طازج مع الطحينة وزيت الزيتون',
            'price' => 25.00,
            'sort_order' => 3,
        ]);

        Product::create([
            'restaurant_id' => $middleEast->id,
            'category_id' => $categories->where('name', 'المشروبات')->first()->id,
            'name' => 'عصير ليمون',
            'description' => 'عصير ليمون طازج مع النعناع',
            'price' => 15.00,
            'sort_order' => 4,
        ]);

        // بيتزا إيطاليا
        $pizzaItalia = $restaurants->where('name', 'بيتزا إيطاليا')->first();

        Product::create([
            'restaurant_id' => $pizzaItalia->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'بيتزا مارجريتا',
            'description' => 'بيتزا إيطالية كلاسيكية مع الجبنة والطماطم والريحان',
            'price' => 75.00,
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $pizzaItalia->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'بيتزا بيبروني',
            'description' => 'بيتزا مع الببروني والجبنة الموزاريلا',
            'price' => 85.00,
            'sort_order' => 2,
        ]);

        Product::create([
            'restaurant_id' => $pizzaItalia->id,
            'category_id' => $categories->where('name', 'المقبلات')->first()->id,
            'name' => 'بروسكيوتو',
            'description' => 'خبز إيطالي محمص مع الجبنة والطماطم',
            'price' => 35.00,
            'sort_order' => 3,
        ]);

        // برجر هاوس
        $burgerHouse = $restaurants->where('name', 'برجر هاوس')->first();

        Product::create([
            'restaurant_id' => $burgerHouse->id,
            'category_id' => $categories->where('name', 'الوجبات السريعة')->first()->id,
            'name' => 'برجر كلاسيك',
            'description' => 'برجر لحم بقري مع الخس والطماطم والجبنة',
            'price' => 55.00,
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $burgerHouse->id,
            'category_id' => $categories->where('name', 'الوجبات السريعة')->first()->id,
            'name' => 'برجر دجاج',
            'description' => 'برجر دجاج مشوي مع الخضروات الطازجة',
            'price' => 45.00,
            'sort_order' => 2,
        ]);

        Product::create([
            'restaurant_id' => $burgerHouse->id,
            'category_id' => $categories->where('name', 'المقبلات')->first()->id,
            'name' => 'بطاطس مقلية',
            'description' => 'بطاطس مقلية مقرمشة مع الكاتشب',
            'price' => 20.00,
            'sort_order' => 3,
        ]);

        // مطعم السوشي الياباني
        $sushiJapan = $restaurants->where('name', 'مطعم السوشي الياباني')->first();

        Product::create([
            'restaurant_id' => $sushiJapan->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'سوشي سالمون',
            'description' => 'سوشي سالمون طازج مع الأرز والوسابي',
            'price' => 120.00,
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $sushiJapan->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'ساشيمي تونة',
            'description' => 'ساشيمي تونة طازجة مع الصويا والوسابي',
            'price' => 150.00,
            'sort_order' => 2,
        ]);

        Product::create([
            'restaurant_id' => $sushiJapan->id,
            'category_id' => $categories->where('name', 'المشروبات')->first()->id,
            'name' => 'شاي أخضر',
            'description' => 'شاي أخضر ياباني تقليدي',
            'price' => 25.00,
            'sort_order' => 3,
        ]);

        // كافيه الحلويات
        $sweetsCafe = $restaurants->where('name', 'كافيه الحلويات')->first();

        Product::create([
            'restaurant_id' => $sweetsCafe->id,
            'category_id' => $categories->where('name', 'الحلويات')->first()->id,
            'name' => 'كنافة',
            'description' => 'كنافة تقليدية مع الجبنة والقطر',
            'price' => 35.00,
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $sweetsCafe->id,
            'category_id' => $categories->where('name', 'الحلويات')->first()->id,
            'name' => 'بسبوسة',
            'description' => 'بسبوسة مع جوز الهند والقطر',
            'price' => 25.00,
            'sort_order' => 2,
        ]);

        Product::create([
            'restaurant_id' => $sweetsCafe->id,
            'category_id' => $categories->where('name', 'المشروبات')->first()->id,
            'name' => 'قهوة تركية',
            'description' => 'قهوة تركية تقليدية مع الهيل',
            'price' => 20.00,
            'sort_order' => 3,
        ]);

        Product::create([
            'restaurant_id' => $sweetsCafe->id,
            'category_id' => $categories->where('name', 'المشروبات')->first()->id,
            'name' => 'شاي بالنعناع',
            'description' => 'شاي بالنعناع الطازج',
            'price' => 15.00,
            'sort_order' => 4,
        ]);
    }
}

