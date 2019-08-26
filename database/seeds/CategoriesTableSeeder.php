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
		$category->picture = '/img/categoria/roundtable_screenshot_1_37205084.png';
        $category->save();

        $category = new Category();
		$category->name = 'Arandano';
		$category->picture = '/img/categoria/roundtable_blueberry_88888888.png';
        $category->save();

		$category = new Category();
		$category->name = 'Banano';
		$category->picture = '/img/categoria/roundtable_banana_37354439.png';
        $category->save();

        $category = new Category();
		$category->name = 'Cacao';
		$category->picture = '/img/categoria/roundtable_cacao_fruit_raw_cacao_beans_with_leaves_cocoa_pod_vector_20963079_89338684.png';
        $category->save();

        $category = new Category();
		$category->name = 'Cafe';
		$category->picture = '/img/categoria/roundtable_coffee_99999999.png';
        $category->save();

        $category = new Category();
		$category->name = 'Chirimoya';
		$category->picture = '/img/categoria/roundtable_chirimoya_02118368.png';
        $category->save();

        $category = new Category();
		$category->name = 'Chocolate';
		$category->picture = '/img/categoria/roundtable_chocolate_56940360.png';
        $category->save();

        $category = new Category();
		$category->name = 'Frutos secos';
		$category->picture = '/img/categoria/roundtable_md_5a8fec026d7cd_47021472.png';
        $category->save();

        $category = new Category();
		$category->name = 'Naranja';
		$category->picture = '/img/categoria/roundtable_orange_22222222.png';
        $category->save();

        $category = new Category();
		$category->name = 'Mandarina';
		$category->picture = '/img/categoria/roundtable_tangerine_35761484.png';
        $category->save();

        $category = new Category();
		$category->name = 'Mango';
		$category->picture = '/img/categoria/roundtable_mango_11111111.png';
        $category->save();

        $category = new Category();
		$category->name = 'Miel de abeja';
		$category->picture = '/img/categoria/roundtable_honey_21993953.png';
        $category->save();

        $category = new Category();
		$category->name = 'Palta';
		$category->picture = '/img/categoria/roundtable_avocado_11111111.png';
        $category->save();

        $category = new Category();
		$category->name = 'Panela';
		$category->picture = '/img/categoria/roundtable_cacao_fruit_raw_cacao_beans_with_leaves_cocoa_pod_vector_20963079_04306466.png';
        $category->save();

        $category = new Category();
		$category->name = 'Piña';
		$category->picture = '/img/categoria/roundtable_pineapple_01202360.png';
        $category->save();

        $category = new Category();
		$category->name = 'Quinua';
		$category->picture = '/img/categoria/roundtable_quinua_64611234.png';
        $category->save();

        $category = new Category();
		$category->name = 'Artesania';
		$category->picture = '/img/categoria/roundtable_aa_32169659.png';
        $category->save();

        $category = new Category();
		$category->name = 'Joyeria';
		$category->picture = '/img/categoria/roundtable_ring_11635359.png';
        $category->save();

        $category = new Category();
		$category->name = 'Tejidos';
		$category->picture = '/img/categoria/roundtable_knitting_51961757.png';
        $category->save();

        $category = new Category();
		$category->name = 'Otros';
		$category->picture = '/img/categoria/roundtable_descarga_44444444.jpg';
        $category->save();
    }
}
