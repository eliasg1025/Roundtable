<?php

use App\Offer;
use Illuminate\Database\Seeder;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$offer = new Offer();
		$offer->title = 'Arandanos de prueba';
		$offer->image_url = '/img/empresa/empresa1/productos/producto1.jpg';
		$offer->category_id = 2;
		$offer->user_id = 30;
		$offer->save();

		$offer = new Offer();
		$offer->title = 'Bananos de prueba';
		$offer->image_url = '/img/empresa/empresa2/empresa2.jpg';
		$offer->category_id = 3;
		$offer->user_id = 30;
		$offer->save();

		$offer = new Offer();
		$offer->title = 'Palta de prueba';
		$offer->image_url = '/img/slider/slider7.jpg';
		$offer->category_id = 15;
		$offer->user_id = 30;
		$offer->save();

		$offer = new Offer();
		$offer->title = 'Frutos secos de prueba';
		$offer->image_url = '/img/-cual-es-el-fruto-seco-mas-saludable-1-655x368.jpg';
		$offer->category_id = 8;
		$offer->user_id = 30;
		$offer->save();

		$offer = new Offer();
		$offer->title = 'Mango de prueba';
		$offer->image_url = '/img/slider/slider8.jpg';
		$offer->category_id = 12;
		$offer->user_id = 30;
		$offer->save();
    }
}
