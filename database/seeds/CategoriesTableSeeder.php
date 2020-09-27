<?php

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
            ['name' => 'Мобильные телефоны', 'code' => 'mobiles', 'description' => 'Описание мобильных телефонов', 'image' => 'categories/mobiles.jpeg'],
            ['name' => 'Портативная техника', 'code' => 'portable', 'description' => 'Описание для раздела портативной техники', 'image' => 'categories/portable.jpeg'],
            ['name' => 'Бытовая техника', 'code' => 'technics', 'description' => 'Раздел с бытовой техникой', 'image' => 'categories/technics.jpeg'],
        ]);
    }
}
