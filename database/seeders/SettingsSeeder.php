<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [

            /* ── General ── */
            'name'    => ['en' => 'Cairo Key',           'ar' => 'كايرو كي'],
            'logo'    => 'settings/logo.png',
            'favicon' => 'settings/favicon.png',

            /* ── Hero ── */
            'hero_cover'        => 'settings/hero.png',
            'hero_title'        => [
                'en' => 'Explore the Beauty of Egypt with Cairo Key',
                'ar' => 'استكشف جمال مصر مع كايرو كي',
            ],
            'hero_description'  => [
                'en' => 'Enjoy an unforgettable tourist experience with Cairo Key, the leading company in furnished apartments, hotels, car rentals, and airport services.',
                'ar' => 'استمتع بتجربة سياحية لا تُنسى مع كايرو كي، الشركة الرائدة في تأجير الشقق المفروشة، الفنادق، السيارات، وخدمات المطار.',
            ],

            /* ── SEO ── */
            'seo_title'       => [
                'en' => 'Cairo Key | Apartments, Hotels, Cars & Airport Services',
                'ar' => 'كايرو كي | تأجير شقق وفنادق وسيارات وخدمات المطار',
            ],
            'seo_description' => [
                'en' => 'Cairo Key is a company specialized in tourism services in Egypt, offering furnished apartments, hotels, car rentals, and airport services at the best prices.',
                'ar' => 'كايرو كي شركة متخصصة في خدمات السياحة في مصر، تأجير شقق مفروشة، فنادق، سيارات، وخدمات المطار بأفضل الأسعار.',
            ],
            'seo_keywords'    => [
                'en' => 'tourism, apartment rental, hotels, car rental, airport services, Cairo, Egypt',
                'ar' => 'سياحة, تأجير شقق, فنادق, تأجير سيارات, خدمات المطار, القاهرة, مصر',
            ],

            /* ── Contact ── */
            'email'    => 'info@cairokey.com',
            'phone'    => '+20 100 000 0000',
            'whatsapp' => '01000000000',
            'address'  => ['en' => 'Cairo, Egypt', 'ar' => 'القاهرة، مصر'],

            /* ── Social Media ── */
            'facebook'  => 'https://facebook.com/cairokey',
            'instagram' => 'https://instagram.com/cairokey',
            'snapchat'  => 'https://snapchat.com/add/cairokey',
            'tiktok'    => 'https://tiktok.com/@cairokey',
            'youtube'   => 'https://youtube.com/@cairokey',
        ];

        Setting::setMany($settings);

        $this->command->info('✅ Settings seeded successfully!');
    }
}
