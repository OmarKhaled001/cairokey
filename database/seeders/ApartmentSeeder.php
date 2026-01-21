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
                'city' => 'الزمالك',
                'active' => true,
                'featured' => true,
                'tags' => ['إطلالة نيلية', 'مفروش فاخر', 'واي فاي مجاني'],
                'images' => [], // أضف مصفوفة فارغة لتجنب مشاكل الـ Cast
            ],
            [
                'name' => 'استوديو أنيق وقريب من الشاطئ',
                'city' => 'لوران',
                'active' => true,
                'featured' => false,
                'tags' => ['قرب البحر', 'استوديو', 'إيجار اقتصادي'],
                'images' => [],
            ],
            [
                'name' => 'شقة عائلية هادئة',
                'city' => 'الشيخ زايد',
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
