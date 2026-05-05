<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [

            [
                'key' => 'general',
                'value' => [
                    'site_title' => 'Metro News',
                    'site_tagline' => '- Latest Breaking News & Headlines',
                    // 'site_description' => '',
                    'logo' => null,
                    // 'logo_dark' => null,
                    'favicon' => null,
                    'email' => 'metronewsinfo@gmail.com',
                    'phone' => '+880 1318-55 33 00',
                    'secondary_phone' => '+880 9606 35 53 55',
                    'address' => 'Address: House #2 (G. Floor), Road #8, Block-D, Section -11, Mirpur, Dhaka-1216',
                    // 'timezone' => 'Asia/Dhaka',
                    // 'language' => 'en',
                    'footer_text' => 'Editor & Publisher: Md. Mejanur Rahman

Metro News is the Digital news media outlet in Bangladesh.across online and multimedia sectors. We are committed to publishing the real news',
                ],
            ],

            // [
            //     'key' => 'seo',
            //     'value' => [
            //         'meta_title' => '',
            //         'meta_description' => '',
            //         'meta_keywords' => '',
            //         'meta_author' => '',
            //         'og_title' => '',
            //         'og_description' => '',
            //         'og_image' => null,
            //         'og_type' => 'website',
            //         'twitter_card' => 'summary_large_image',
            //         'canonical_url' => '',
            //         'robots_meta' => 'index, follow',
            //         'schema_enabled' => true,
            //         'default_meta_image' => null,
            //         'sitemap_enabled' => true,
            //     ],
            // ],

            [
                'key' => 'social',
                'value' => [
                    'facebook' => 'https://www.facebook.com/metronewsbangla',
                    'twitter' => '#',
                    'instagram' => '#',
                    'linkedin' => '#',
                    'youtube' => '#',
                    'tiktok' => '#',
                    'whatsapp' => '',
                    'telegram' => '',
                ],
            ],

            [
                'key' => 'analytics',
                'value' => [
                    'google_analytics_id' => '',
                    'google_tag_manager' => '',
                    'facebook_pixel' => '',
                    'custom_head_script' => '',
                    'custom_body_script' => '',
                ],
            ],

            // [
            //     'key' => 'theme',
            //     'value' => [
            //         'primary_color' => '#000000',
            //         'secondary_color' => '#ffffff',
            //         'font' => 'Inter',
            //         'dark_mode_enabled' => false,
            //         'container_width' => 'container',
            //     ],
            // ],

            // [
            //     'key' => 'system',
            //     'value' => [
            //         'maintenance_mode' => false,
            //         'registration_enabled' => true,
            //         'login_captcha' => false,
            //         'max_upload_size' => 2048,
            //     ],
            // ],

        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate([
                'key' => $setting['key'],
            ], [
                'value' => json_encode($setting['value']),
            ]);
        }

    }
}
