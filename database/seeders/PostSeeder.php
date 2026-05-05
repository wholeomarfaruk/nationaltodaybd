<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DB::table('categories')->pluck('id', 'name');

        $dummyPosts = [
            "বাংলাদেশে আজকের সর্বশেষ খবর প্রকাশিত হলো।",
            "খেলাধুলায় নতুন সাফল্যের গল্প তৈরি হচ্ছে প্রতিদিন।",
            "রাজনীতি ও অর্থনীতির সাম্প্রতিক বিশ্লেষণ।",
            "শিক্ষা ব্যবস্থায় নতুন দিগন্ত উন্মোচন।",
            "সারাদেশ জুড়ে বিভিন্ন কার্যক্রম চলছে।",
            "আন্তর্জাতিক অঙ্গনে বাংলাদেশের অগ্রযাত্রা।"
        ];

        foreach ($categories as $categoryName => $categoryId) {
            for ($i = 1; $i <= 6; $i++) {
                $title = $categoryName . " - ডামি পোস্ট " . $i;
                DB::table('posts')->insert([
                    'title'       => $title,
                    'excerpt'     => "এটি একটি সংক্ষিপ্ত বিবরণ: " . $title,
                    'content'     => $dummyPosts[array_rand($dummyPosts)] . " বিস্তারিত পড়ুন।",
                    'slug'        => Str::slug($categoryName . '-post-' . $i . '-' . Str::random(5)),
                    'status'      => 'published',
                    'is_featured' => (bool)random_int(0, 1),
                    'category_id' => $categoryId,
                    'user_id'     => 1, // ধরে নিচ্ছি admin user id = 1
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }
    }
}
