<?php

namespace Database\Seeders;

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
        DB::table('categories')->insert([
            [
                'name' => 'カブトムシ'
            ],
            [
                'name' => 'クワガタムシ'
            ],
            [
                'name' => '色虫'
            ],
            [
                'name' => 'その他'
            ]
        ]);
    }
}
