<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    public function run()
    {
        $apartments = [
            [
                'name' => 'شقة فاخرة بإطلالة على النيل - القاهرة',
                'description' => 'شقة عصرية بفرش فخم في قلب القاهرة، إطلالة مباشرة على نهر النيل.',
                'governorate' => 'القاهرة',
                'city' => 'الزمالك',
                'address' => 'شارع أبو الفدا، عمارة 45',
                'location' => '30.0543, 31.2263',
                'rooms' => 3,
                'video_url' => 'https://www.youtube.com/watch?v=example1',
                'price_per_night' => 1500,
                'rating' => 5,
                'active' => true,
                'featured' => true,
                'tags' => ['إطلالة نيلية', 'مفروش فاخر', 'واي فاي مجاني'],
            ],

            [
                'name' => 'استوديو أنيق وقريب من الشاطئ - الإسكندرية',
                'description' => 'استوديو مميز قريب جدًا من البحر.',
                'governorate' => 'الإسكندرية',
                'city' => 'لوران',
                'address' => 'شارع عبد المنعم، برج اللؤلؤة',
                'location' => '31.2480, 29.9575',
                'rooms' => 1,
                'video_url' => 'https://www.youtube.com/watch?v=example2',
                'price_per_night' => 450,
                'rating' => 4,
                'active' => true,
                'featured' => false,
                'tags' => ['قرب البحر', 'استوديو', 'إيجار اقتصادي'],
            ],

            [
                'name' => 'شقة عائلية هادئة - الجيزة',
                'description' => 'شقة كبيرة مناسبة للعائلات.',
                'governorate' => 'الجيزة',
                'city' => 'الشيخ زايد',
                'address' => 'الحي 16، مجاورة 3',
                'location' => '30.0898, 30.9850',
                'rooms' => 4,
                'video_url' => null,
                'price_per_night' => 900,
                'rating' => 4,
                'active' => true,
                'featured' => false,
                'tags' => ['4 غرف', 'منطقة هادئة', 'موقف خاص'],
            ],
        ];

        foreach ($apartments as $data) {

            $apartment = Apartment::create([
                'name'             => $data['name'],
                'description'       => $data['description'],
                'governorate'       => $data['governorate'],
                'city'              => $data['city'],
                'address'           => $data['address'],
                'location'          => $data['location'],
                'rooms'             => $data['rooms'],
                'video_url'         => $data['video_url'],
                'price_per_night'   => $data['price_per_night'],
                'rating'            => $data['rating'],
                'active'            => $data['active'],
                'featured'          => $data['featured'],
            ]);
        }
    }
}
