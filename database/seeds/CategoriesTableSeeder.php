<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = 'Aguaymanto';
        $category->save();

        $category = new Category();
        $category->name = 'Arandano';
        $category->save();

        $category = new Category();
        $category->name = 'Banano';
        $category->save();

        $category = new Category();
        $category->name = 'Cacao';
        $category->save();

        $category = new Category();
        $category->name = 'Cafe';
        $category->save();

        $category = new Category();
        $category->name = 'Chirimoya';
        $category->save();

        $category = new Category();
        $category->name = 'Chocolate';
        $category->save();

        $category = new Category();
        $category->name = 'Frutos secos';
        $category->save();

        $category = new Category();
        $category->name = 'Naranja';
        $category->save();

        $category = new Category();
        $category->name = 'Mandarina';
        $category->save();

        $category = new Category();
        $category->name = 'Mango';
        $category->save();

        $category = new Category();
        $category->name = 'Miel de abeja';
        $category->save();

        $category = new Category();
        $category->name = 'Palta';
        $category->save();

        $category = new Category();
        $category->name = 'Panel';
        $category->save();

        $category = new Category();
        $category->name = 'Piña';
        $category->save();

        $category = new Category();
        $category->name = 'Quinua';
        $category->save();

        $category = new Category();
        $category->name = 'Artesania';
        $category->save();

        $category = new Category();
        $category->name = 'Joyeria';
        $category->save();

        $category = new Category();
        $category->name = 'Tejidos';
        $category->save();

        $category = new Category();
        $category->name = 'Otros';
        $category->save();
    }
}
