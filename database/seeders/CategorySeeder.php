<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        $categories =
            [
                [
                    'en'=>'Category One',
                    'ar'=>'القسم الأول'
                ],
                [
                    'en'=>'Category Two',
                    'ar'=>'القسم الثانى'
                ],
                [
                    'en'=>'Category Three',
                    'ar'=>'القسم 3'
                ],
                [
                    'en'=>'Category 4',
                    'ar'=>'القسم الرابع'
                ],
                [
                    'en'=>'Category Five',
                    'ar'=>'القسم الخامس'
                ],
                [
                    'en'=>'Category 6',
                    'ar'=>'القسم السادس'
                ],
             ];

        foreach ($categories as $category) {

            Category::create (['name' => $category]);

        } // End of Foreach

    } // End of Run


} // End of Seeder
