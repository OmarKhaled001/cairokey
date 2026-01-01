<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Setting::setMany([

            /* ================= General ================= */
            'name' => 'كايرو كي',
            'tagline' => 'بوابتك المتكاملة لخدمات السياحة في مصر',

            /* ================= Branding ================= */
            'logo' => 'settings/logo.png',
            'favicon' => 'settings/favicon.png',

            /* ================= SEO ================= */
            'seo_title' => 'كايرو كي | تأجير شقق وفنادق وسيارات وخدمات المطار',
            'seo_description' => 'كايرو كي شركة متخصصة في خدمات السياحة في مصر، تأجير شقق مفروشة، فنادق، سيارات، وخدمات استقبال وتوصيل المطار بأفضل الأسعار.',
            'seo_keywords' => 'سياحة, تأجير شقق, فنادق, تأجير سيارات, خدمات المطار, القاهرة, مصر',

            /* ================= Contact ================= */
            'email' => 'info@cairokey.com',
            'phone' => '+20 100 000 0000',
            'whatsapp' => 'https://wa.me/201000000000',

            /* ================= Social Media ================= */
            'facebook' => 'https://facebook.com/cairokey',
            'instagram' => 'https://instagram.com/cairokey',
            'snapchat' => 'https://snapchat.com/add/cairokey',
            'tiktok' => 'https://tiktok.com/@cairokey',
            'youtube' => 'https://youtube.com/@cairokey',


        ]);
    }
}
