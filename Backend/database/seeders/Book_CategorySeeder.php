<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Book_CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $json=file_get_contents(database_path('seeders/datas/book_category.json'));
         $book_categorydata=json_decode($json,true);
         DB::table('book_category')->insert($book_categorydata);
    }
}
