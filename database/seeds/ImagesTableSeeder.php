<?php

use App\Image;
use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image = new Image();
        $image->url = '/img/empresa/empresa1/portada1.jpg';
        $image->user_id = 30;
        $image->operation_id = 1;
        $image->save();

        $image = new Image();
        $image->url = '/img/empresa/empresa1/portada2.jpg';
        $image->user_id = 30;
        $image->operation_id = 1;
        $image->save();
    }
}
