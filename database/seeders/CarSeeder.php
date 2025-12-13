<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // مصفوفة البيانات المحدثة لتشمل Tags (الميزات)
        $cars = [
            [
                'name' => 'تويوتا كامري 2024 - فئة LE',
                'description' => 'سيارة سيدان موثوقة واقتصادية، مثالية للتنقلات اليومية داخل المدينة.',
                'brand' => 'تويوتا',
                'model' => 'كامري',
                'year' => 2024,
                'price_per_day' => 250.00,
                'rating' => 4,
                'active' => true,
                'featured' => false,
                'tags' => [
                    'لون أبيض',
                    '5 ركاب',
                    'تكييف أوتوماتيكي',
                    'نظام ملاحة',
                    'كفاءة وقود عالية',
                    'سيدان'
                ],
            ],
            [
                'name' => 'مرسيدس بنز S-Class - فخامة التنقل',
                'description' => 'أقصى درجات الفخامة والراحة. مجهزة بأحدث التقنيات وخدمات الرفاهية.',
                'brand' => 'مرسيدس بنز',
                'model' => 'S-Class',
                'year' => 2023,
                'price_per_day' => 800.00,
                'rating' => 5,
                'active' => true,
                'featured' => true,
                'tags' => [
                    'لون أسود',
                    '4 ركاب',
                    'مقاعد تدليك',
                    'سقف بانورامي',
                    'قيادة ذاتية جزئية',
                    'جلد فاخر'
                ],
            ],
            [
                'name' => 'هيونداي إلنترا - اقتصادية',
                'description' => 'خيار ممتاز للتأجير بأسعار معقولة، كفاءة عالية في استهلاك الوقود.',
                'brand' => 'هيونداي',
                'model' => 'إلنترا',
                'year' => 2022,
                'price_per_day' => 180.00,
                'rating' => 3,
                'active' => true,
                'featured' => false,
                'tags' => [
                    'لون فضي',
                    '5 ركاب',
                    'تكييف يدوي',
                    'بلوتوث',
                    'إقتصادية جداً',
                    'سيدان صغيرة'
                ],
            ],
            [
                'name' => 'بي إم دبليو X5 - دفع رباعي فاخر',
                'description' => 'سيارة رياضية متعددة الاستخدامات (SUV) تجمع بين القوة والأناقة.',
                'brand' => 'بي إم دبليو',
                'model' => 'X5',
                'year' => 2023,
                'price_per_day' => 650.00,
                'rating' => 5,
                'active' => true,
                'featured' => true,
                'tags' => [
                    'لون كحلي',
                    '7 ركاب',
                    'دفع رباعي',
                    'مقاعد جلد',
                    'شاشة خلفية',
                    'SUV'
                ],
            ],
            [
                'name' => 'هوندا سيفيك - نقل يدوي',
                'description' => 'سيارة شبابية ممتعة في القيادة، بناقل حركة يدوي للمحترفين.',
                'brand' => 'هوندا',
                'model' => 'سيفيك',
                'year' => 2021,
                'price_per_day' => 200.00,
                'rating' => 4,
                'active' => true,
                'featured' => false,
                'tags' => [
                    'لون أحمر',
                    '5 ركاب',
                    'جير عادي',
                    'محرك رياضي',
                    'فتحة سقف'
                ],
            ],
        ];

        foreach ($cars as $data) {
            $tags = $data['tags'] ?? [];
            unset($data['tags']);

            $car = Car::create($data);

            if ($tags) {
                $car->syncTags($tags);
            }
        }
    }
}
