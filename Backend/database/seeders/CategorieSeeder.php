<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json=file_get_contents(database_path('seeders/datas/categories.json'));
        $category=json_decode($json,true);
        DB::table('categories')->insert($category);
    }
}
