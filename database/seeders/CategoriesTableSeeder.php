<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table ('categories')->truncate();
        Category::truncate();
        // $categories = [
        //     [
        //         'name' => 'Điện thoại',
        //         'slug' => 'dien-thoai',

        //     ],
        //     [
        //         'name' => 'máy tính',
        //         'slug' => 'may-tinh',

        //     ],
        //     [
        //         'name' => 'Thiết bị',
        //         'slug' => 'thiet-bi',

        //     ],
        //     [
        //         'name' => 'Mạng',
        //         'slug' => 'Mạng',
        //     ]
        //     ];
        //     foreach ($categories as $category) {
        //         DB::table('categories')->insert($category);
        //     }

        Category::factory()->count(10)->create();
    }
}
