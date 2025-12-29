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
                'name' => 'حجز تذاكر الطيران',
                'description' => 'خدمة حجز تذاكر الطيران.',
                'price' => 500,
                'active' => true,
                'featured' => false,
                'tags' => ['تذاكر طيران', 'حجز', 'طيران'],
            ],
            [
                'name' => 'استقبال من المطار',
                'description' => 'خدمة استقبال من وإلى المطار.',
                'price' => 700,
                'active' => true,
                'featured' => true,
                'tags' => ['مطار', 'VIP', 'راحة'],
            ],
        ];

        foreach ($services as $data) {
            Service::create($data);
        }
    }
}
