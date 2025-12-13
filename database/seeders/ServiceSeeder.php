<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'خدمة تنظيف الشقق',
                'description' => 'تنظيف شامل قبل وبعد الإقامة.',
                'price' => 300,
                'active' => true,
                'featured' => true,
                'tags' => ['تنظيف', 'تعقيم', 'خدمة سريعة'],
            ],
            [
                'name' => 'خدمة سائق خاص',
                'description' => 'سائق محترف داخل المدينة.',
                'price' => 500,
                'active' => true,
                'featured' => false,
                'tags' => ['سائق', 'تنقل', 'راحة'],
            ],
            [
                'name' => 'استقبال من المطار',
                'description' => 'استقبال VIP من وإلى المطار.',
                'price' => 700,
                'active' => true,
                'featured' => true,
                'tags' => ['مطار', 'VIP', 'راحة'],
            ],
        ];

        foreach ($services as $data) {
            $tags = $data['tags'] ?? [];
            unset($data['tags']);

            $service = Service::create($data);

            if ($tags) {
                $service->syncTags($tags);
            }
        }
    }
}
