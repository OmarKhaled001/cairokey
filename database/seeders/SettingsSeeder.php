<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        // DB::table('settings')->truncate();

        $settings = [

            /* ── General ── */
            'name'         => ['en' => 'Cairo Key', 'ar' => 'كايرو كي'],
            'logo'         => 'assets/images/logo.svg',
            'logo_light'   => 'assets/images/logo-w.svg',
            'favicon'      => 'assets/images/favico.svg',

            /* ── Hero ── */
            'hero_cover'        => 'assets/images/cover.png',
            'hero_title'        => [
                'en' => 'Explore the Beauty of Egypt with CairoKey',
                'ar' => 'استكشف جمال مصر مع كايروكي',
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
            'phone'    => '+20 112 399 1452',
            'whatsapp' => '+201123991452',
            'address'  => ['en' => 'Cairo, Egypt', 'ar' => 'القاهرة، مصر'],

            /* ── Social Media ── */
            'facebook'  => 'https://www.facebook.com/share/18SCdYG7TJ/',
            'instagram' => 'https://www.instagram.com/cairokey2026',
            'tiktok'    => 'https://www.tiktok.com/@cairokey2026?_r=1&_t=ZS-94iaFkAus9X',
        ];

        Setting::setMany($settings);

        $this->command->info('✅ Settings updated & Defaults cleared successfully!');
    }
}
