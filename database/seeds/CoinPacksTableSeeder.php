<?php

use App\CoinPack;
use Illuminate\Database\Seeder;

class CoinPacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coin_pack = new CoinPack();
        $coin_pack->name = 'Pack de 20';
        $coin_pack->precio = 20;
        $coin_pack->amount_coins = 20;
        $coin_pack->save();

        $coin_pack = new CoinPack();
        $coin_pack->name = 'Pack de 50';
        $coin_pack->precio = 40;
        $coin_pack->amount_coins = 50;
        $coin_pack->save();

        $coin_pack = new CoinPack();
        $coin_pack->name = 'Pack de 70';
        $coin_pack->precio = 50;
        $coin_pack->amount_coins = 70;
        $coin_pack->save();

        $coin_pack = new CoinPack();
        $coin_pack->name = 'Pack de 80';
        $coin_pack->precio = 60;
        $coin_pack->amount_coins = 80;
        $coin_pack->save();
    }
}
