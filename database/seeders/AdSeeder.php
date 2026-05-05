<?php

namespace Database\Seeders;

use App\Models\Ad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $ads=[
            // [
            // 'id'          => 1,
            // 'title'       => 'Default Ad',
            // 'description' => 'This is a default ad description.',
            // 'link'        => '#',
            // 'status'      => 1,
            // 'expire_at'   => now(),
            // 'ad_rule'     => 'any size',
            // 'is_primary'  => 1,
            // ],
            // [
            //     'id'          => 2,
            //     'title'       => 'Home Sidebar Ad-1',
            //     'description' => 'This is a sidebar ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(30),
            //     'ad_rule'     => '300x250',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 3,
            //     'title'       => 'Home Sidebar Ad-2',
            //     'description' => 'This is a header ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(60),
            //     'ad_rule'     => '728x90',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 4,
            //     'title'       => 'Post Page Top Ad',
            //     'description' => 'This is a sidebar ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(90),
            //     'ad_rule'     => '300x250',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 5,
            //     'title'       => 'Post Page Sidebar Ad-1',
            //     'description' => 'This is a sidebar ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(120),
            //     'ad_rule'     => '300x250',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 6,
            //     'title'       => 'Post Page Sidebar Ad-2',
            //     'description' => 'This is a sidebar ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(150),
            //     'ad_rule'     => '300x250',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 7,
            //     'title'       => 'Post Bottom Ad',
            //     'description' => 'This is a sidebar ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(180),
            //     'ad_rule'     => 'full-width',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 8,
            //     'title'       => 'Home - Above section Ad-1',
            //     'description' => 'This is a home page under hero section ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(180),
            //     'ad_rule'     => 'full-width',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 9,
            //     'title'       => 'Home - Above section Ad-2',
            //     'description' => 'This is a home page under hero section ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(180),
            //     'ad_rule'     => 'full-width',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 10,
            //     'title'       => 'Home - Above section Ad-3',
            //     'description' => 'This is a home page under hero section ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(180),
            //     'ad_rule'     => 'full-width',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 11,
            //     'title'       => 'Home - Above section Ad-4',
            //     'description' => 'This is a home page under hero section ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(180),
            //     'ad_rule'     => 'full-width',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 12,
            //     'title'       => 'Home - Above section Ad-5',
            //     'description' => 'This is a home page under hero section ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(180),
            //     'ad_rule'     => 'full-width',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 13,
            //     'title'       => 'Home - Above section Ad-6',
            //     'description' => 'This is a home page under hero section ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(180),
            //     'ad_rule'     => 'full-width',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 14,
            //     'title'       => 'Home - Above section Ad-7',
            //     'description' => 'This is a home page under hero section ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(180),
            //     'ad_rule'     => 'full-width',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 15,
            //     'title'       => 'Home - Above section Ad-8',
            //     'description' => 'This is a home page under hero section ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(180),
            //     'ad_rule'     => 'full-width',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 16,
            //     'title'       => 'Home - Above section Ad-9',
            //     'description' => 'This is a home page under hero section ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(180),
            //     'ad_rule'     => 'full-width',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 17,
            //     'title'       => 'On every page - Above Footer section',
            //     'description' => 'This is a home page under hero section ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(180),
            //     'ad_rule'     => 'full-width',
            //     'is_primary'  => 0,
            // ],
            // [
            //     'id'          => 18,
            //     'title'       => 'On every page - under Header section',
            //     'description' => 'This is a home page under hero section ad description.',
            //     'link'        => '#',
            //     'status'      => 1,
            //     'expire_at'   => now()->addDays(180),
            //     'ad_rule'     => 'full-width',
            //     'is_primary'  => 0,
            // ],
            [
                'id'          => 19,
                'title'       => 'On every page - Top Header section',
                'description' => 'show this ad on every page top header section',
                'link'        => '#',
                'status'      => 1,
                'expire_at'   => now()->addDays(180),
                'ad_rule'     => 'full-width',
                'is_primary'  => 0,
            ],

        ];
        foreach($ads as $ad){
            Ad::create($ad);
        }
    }
}
