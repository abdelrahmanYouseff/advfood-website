<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = [
            [
                'name' => 'مطعم الشرق الأوسط',
                'description' => 'أشهى الأطباق الشرقية التقليدية مع نكهات عربية أصيلة',
                'address' => 'شارع النيل، القاهرة الجديدة',
                'phone' => '01234567890',
                'email' => 'info@middleeast-restaurant.com',
                'rating' => 4.8,
                'delivery_time' => 30,
                'delivery_fee' => 15.00,
                'minimum_order' => 50.00,
                'working_hours' => [
                    'sunday' => ['09:00', '23:00'],
                    'monday' => ['09:00', '23:00'],
                    'tuesday' => ['09:00', '23:00'],
                    'wednesday' => ['09:00', '23:00'],
                    'thursday' => ['09:00', '23:00'],
                    'friday' => ['09:00', '23:00'],
                    'saturday' => ['09:00', '23:00'],
                ],
            ],
            [
                'name' => 'بيتزا إيطاليا',
                'description' => 'أفضل البيتزا الإيطالية الأصيلة مع مكونات طازجة',
                'address' => 'شارع المعادي، المعادي',
                'phone' => '01234567891',
                'email' => 'info@pizza-italia.com',
                'rating' => 4.6,
                'delivery_time' => 25,
                'delivery_fee' => 12.00,
                'minimum_order' => 40.00,
                'working_hours' => [
                    'sunday' => ['10:00', '22:00'],
                    'monday' => ['10:00', '22:00'],
                    'tuesday' => ['10:00', '22:00'],
                    'wednesday' => ['10:00', '22:00'],
                    'thursday' => ['10:00', '22:00'],
                    'friday' => ['10:00', '22:00'],
                    'saturday' => ['10:00', '22:00'],
                ],
            ],
            [
                'name' => 'برجر هاوس',
                'description' => 'أشهى البرجر الأمريكي مع البطاطس المقرمشة',
                'address' => 'شارع مصر الجديدة، مصر الجديدة',
                'phone' => '01234567892',
                'email' => 'info@burgerhouse.com',
                'rating' => 4.4,
                'delivery_time' => 20,
                'delivery_fee' => 10.00,
                'minimum_order' => 35.00,
                'working_hours' => [
                    'sunday' => ['11:00', '00:00'],
                    'monday' => ['11:00', '00:00'],
                    'tuesday' => ['11:00', '00:00'],
                    'wednesday' => ['11:00', '00:00'],
                    'thursday' => ['11:00', '00:00'],
                    'friday' => ['11:00', '00:00'],
                    'saturday' => ['11:00', '00:00'],
                ],
            ],
            [
                'name' => 'مطعم السوشي الياباني',
                'description' => 'أفضل السوشي والساشيمي الياباني الأصيل',
                'address' => 'شارع الزمالك، الزمالك',
                'phone' => '01234567893',
                'email' => 'info@sushi-japan.com',
                'rating' => 4.9,
                'delivery_time' => 35,
                'delivery_fee' => 20.00,
                'minimum_order' => 80.00,
                'working_hours' => [
                    'sunday' => ['12:00', '22:00'],
                    'monday' => ['12:00', '22:00'],
                    'tuesday' => ['12:00', '22:00'],
                    'wednesday' => ['12:00', '22:00'],
                    'thursday' => ['12:00', '22:00'],
                    'friday' => ['12:00', '22:00'],
                    'saturday' => ['12:00', '22:00'],
                ],
            ],
            [
                'name' => 'كافيه الحلويات',
                'description' => 'أشهى الحلويات الشرقية والغربية مع القهوة العربية',
                'address' => 'شارع المعادي، المعادي',
                'phone' => '01234567894',
                'email' => 'info@sweets-cafe.com',
                'rating' => 4.7,
                'delivery_time' => 15,
                'delivery_fee' => 8.00,
                'minimum_order' => 25.00,
                'working_hours' => [
                    'sunday' => ['08:00', '23:00'],
                    'monday' => ['08:00', '23:00'],
                    'tuesday' => ['08:00', '23:00'],
                    'wednesday' => ['08:00', '23:00'],
                    'thursday' => ['08:00', '23:00'],
                    'friday' => ['08:00', '23:00'],
                    'saturday' => ['08:00', '23:00'],
                ],
            ],
        ];

        foreach ($restaurants as $restaurant) {
            Restaurant::create($restaurant);
        }
    }
}

