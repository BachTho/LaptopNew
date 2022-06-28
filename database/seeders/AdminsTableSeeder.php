<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { // DB::table ('categories')->truncate();
        Admin::truncate();
        $admins = [
            [
                'name' => 'ad',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('1'),
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => 't',
                'email' => 'tho@gmail.com',
                'password' => Hash::make('1'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        foreach ($admins as $admin) {
            DB::table('admins')->insert($admin);
        }
    }
}
