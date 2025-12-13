<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        $hotels = [
            [
                'name' => 'فندق النيل البانورامي - القاهرة',
                'description' => 'فندق فاخر في قلب القاهرة بإطلالة مباشرة على النيل، قريب من المناطق السياحية والخدمات.',
                'governorate' => 'القاهرة',
                'city' => 'الزمالك',
                'address' => 'شارع أبو الفدا - كورنيش النيل',
                'location' => '30.0543, 31.2263',
                'price_per_night' => 2200,
                'rating' => 5,
                'active' => true,
                'featured' => true,
                'tags' => ['إطلالة نيلية', 'إفطار مجاني', 'واي فاي', 'مسبح', 'مطعم فاخر'],
            ],
            [
                'name' => 'فندق الشاطئ الأزرق - الإسكندرية',
                'description' => 'فندق مريح على البحر مباشرة، مناسب للعائلات ومحبي الأجواء الهادئة.',
                'governorate' => 'الإسكندرية',
                'city' => 'سيدي بشر',
                'address' => 'طريق البحر - بجوار فندق الهيلتون',
                'location' => '31.2156, 29.9486',
                'price_per_night' => 950,
                'rating' => 4,
                'active' => true,
                'featured' => false,
                'tags' => ['قرب البحر', 'إطلالة بحرية', 'مطعم', 'موقف سيارات', 'مكيف'],
            ],
            [
                'name' => 'منتجع صن رايز - الغردقة',
                'description' => 'منتجع فاخر على البحر الأحمر يقدم أنشطة مائية وخدمات ترفيهية عالمية.',
                'governorate' => 'البحر الأحمر',
                'city' => 'الغردقة',
                'address' => 'طريق القرى السياحية',
                'location' => '27.2579, 33.8116',
                'price_per_night' => 1800,
                'rating' => 5,
                'active' => true,
                'featured' => true,
                'tags' => ['شاطئ خاص', 'أكوابارك', 'spa', 'صالة رياضية', 'بوفيه مفتوح'],
            ],
        ];

        foreach ($hotels as $data) {
            $tags = $data['tags'] ?? [];
            unset($data['tags']);

            $hotel = Hotel::create($data);

            if ($tags) {
                $hotel->syncTags($tags);
            }
        }
    }
}
