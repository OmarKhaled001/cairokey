<?php


namespace Database\seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    public function run()
    {
        $apartments = [
            [
                'name' => 'شقة فاخرة بإطلالة على النيل',
                'description' => 'شقة عصرية بفرش فخم في قلب القاهرة، إطلالة مباشرة على نهر النيل.',
                'governorate' => 'القاهرة',
                'city' => 'الزمالك',
                'address' => 'شارع أبو الفدا، عمارة 45',
                'location' => '30.0543,31.2263',
                'rooms' => 3,
                'price_per_night' => 1500,
                'rating' => 5,
                'active' => true,
                'featured' => true,
                'tags' => ['إطلالة نيلية', 'مفروش فاخر', 'واي فاي مجاني'],
                'images' => [], // أضف مصفوفة فارغة لتجنب مشاكل الـ Cast
            ],
            [
                'name' => 'استوديو أنيق وقريب من الشاطئ',
                'description' => 'استوديو مميز قريب جدًا من البحر.',
                'governorate' => 'الإسكندرية',
                'city' => 'لوران',
                'address' => 'شارع عبد المنعم، برج اللؤلؤة',
                'location' => '31.2480,29.9575',
                'rooms' => 1,
                'price_per_night' => 450,
                'rating' => 4,
                'active' => true,
                'featured' => false,
                'tags' => ['قرب البحر', 'استوديو', 'إيجار اقتصادي'],
                'images' => [],
            ],
            [
                'name' => 'شقة عائلية هادئة',
                'description' => 'شقة كبيرة مناسبة للعائلات.',
                'governorate' => 'الجيزة',
                'city' => 'الشيخ زايد',
                'address' => 'الحي 16، مجاورة 3',
                'location' => '30.0898,30.9850',
                'rooms' => 4,
                'price_per_night' => 900,
                'rating' => 4,
                'active' => true,
                'featured' => false,
                'tags' => ['عائلات', 'منطقة هادئة', 'موقف خاص'],
                'images' => [],
            ],
        ];

        foreach ($apartments as $data) {
            // نستخدم updateOrCreate بناءً على الاسم لمنع التكرار
            Apartment::updateOrCreate(['name' => $data['name']], $data);
        }
    }
}
