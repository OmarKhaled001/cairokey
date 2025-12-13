<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    public function run(): void
    {
        $offers = [
            [
                'name' => 'عرض الصيف – شقة + سيارة',
                'description' => 'خصم خاص على شقة فاخرة مع سيارة لمدة 3 أيام.',
                'price' => 2500,
                'original_price' => 3200,
                'items' => [
                    ['type' => 'apartment', 'id' => 1],
                    ['type' => 'car', 'id' => 2],
                ],
                'start_date' => now()->subDays(2),
                'end_date' => now()->addDays(15),
                'active' => true,
                'featured' => true,
            ],
            [
                'name' => 'عرض شهر العسل',
                'description' => 'إقامة فندقية + خدمة استقبال VIP.',
                'price' => 4000,
                'original_price' => 5000,
                'items' => [
                    ['type' => 'hotel', 'id' => 1],
                    ['type' => 'service', 'id' => 3],
                ],
                'start_date' => now(),
                'end_date' => now()->addDays(20),
                'active' => true,
                'featured' => false,
            ],
        ];

        foreach ($offers as $data) {
            Offer::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'description' => $data['description'],
                'price' => $data['price'],
                'original_price' => $data['original_price'],
                'items' => $data['items'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'active' => $data['active'],
                'featured' => $data['featured'],
            ]);
        }
    }
}
