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
                    'en'=>'Album One',
                    'ar'=>'الألبوم الأول'
                ],
                [
                    'en'=>'Album Two',
                    'ar'=>'الألبوم الثانى'
                ],
                [
                    'en'=>'Album Three',
                    'ar'=>'الألبوم 3'
                ],
                [
                    'en'=>'Album 4',
                    'ar'=>'الألبوم الرابع'
                ],
                [
                    'en'=>'Album Five',
                    'ar'=>'الألبوم الخامس'
                ],
                [
                    'en'=>'Album 6',
                    'ar'=>'الألبوم السادس'
                ],
             ];

        foreach ($categories as $category) {

            Category::create (['name' => $category]);

        } // End of Foreach

    } // End of Run


} // End of Seeder
