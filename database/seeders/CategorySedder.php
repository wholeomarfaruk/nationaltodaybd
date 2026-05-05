<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySedder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $array=[
            ['id' => 1, 'name' => 'জাতীয়', 'slug' => 'jatio', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'রাজনীতি', 'slug' => 'rajniti', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'বাণিজ্য', 'slug' => 'banijjo', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'সারাদেশ', 'slug' => 'saradesh', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'আন্তর্জাতিক', 'slug' => 'antorjatik', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'খেলা', 'slug' => 'khela', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'name' => 'শিক্ষা', 'slug' =>'shikkha', 	'parent_id'=> null,'created_at'=>now(),'updated_at'=>now()],
            ['id' => 8, 'name' => 'মোটামুটি', 'slug' => 'motamuti', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9,'name'=>'অপরাধ','slug'=>'oporadh','parent_id'=>null,'created_at'=>now(),'updated_at'=>now()],
            ['id' =>10,'name'=>'বিনদন','slug'=>'binodon','parent_id'=>null,'created_at'=>now(),'updated_at'=>now()],

        ];

        foreach ($array as $category) {
            Category::updateOrCreate(
                ['id' => $category['id']],
                [
                    'name' => $category['name'],
                    'slug' => $category['slug'],
                    'parent_id' => $category['parent_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
           
        }
       
    }
}
