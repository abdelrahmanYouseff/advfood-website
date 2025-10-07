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
                'name' => 'Tant Bakiza',
                'description' => 'Tant Bakiza.',
                'logo' => 'rest/bakiza-logo.png',
                'cover_image' => 'rest/bakiza-logo.png',
                'address' => 'Al Muroj, Riyadh',
                'phone' => '+966 50 784 4079',
                'email' => 'info@adv-line.sa',
                'rating' => 4.8,
                'delivery_time' => 30,
                'delivery_fee' => 15.00,
                'minimum_order' => 50.00,
                'is_active' => true,
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
                'name' => 'Delawa',
                'description' => 'Delawa',
                'logo' => 'rest/delawa-logo.png',
                'cover_image' => 'rest/delawa-logo.png',
                'address' => 'Al Muroj, Riyadh',
                'phone' => '+966 50 784 4079',
                'email' => 'info@adv-line.sa',
                'rating' => 4.5,
                'delivery_time' => 35,
                'delivery_fee' => 20.00,
                'minimum_order' => 60.00,
                'is_active' => true,
                'working_hours' => [
                    'sunday' => ['10:00', '23:00'],
                    'monday' => ['10:00', '23:00'],
                    'tuesday' => ['10:00', '23:00'],
                    'wednesday' => ['10:00', '23:00'],
                    'thursday' => ['10:00', '23:00'],
                    'friday' => ['10:00', '23:00'],
                    'saturday' => ['10:00', '23:00'],
                ],
            ],
            [
                'name' => 'Gather Us',
                'description' => 'Gather Us',
                'logo' => 'rest/gatherus-logo.png',
                'cover_image' => 'rest/gatherus-logo.png',
                'address' => 'Al Muroj, Riyadh',
                'phone' => '+966 50 784 4079',
                'email' => 'info@adv-line.sa',
                'rating' => 4.6,
                'delivery_time' => 25,
                'delivery_fee' => 12.00,
                'minimum_order' => 40.00,
                'is_active' => true,
                'working_hours' => [
                    'sunday' => ['11:00', '22:00'],
                    'monday' => ['11:00', '22:00'],
                    'tuesday' => ['11:00', '22:00'],
                    'wednesday' => ['11:00', '22:00'],
                    'thursday' => ['11:00', '22:00'],
                    'friday' => ['11:00', '22:00'],
                    'saturday' => ['11:00', '22:00'],
                ],
            ],
        ];

        foreach ($restaurants as $restaurant) {
            Restaurant::create($restaurant);
        }
    }
}

