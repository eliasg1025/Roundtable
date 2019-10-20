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
        $coin_pack->name = 'Pack de 10 coins';
		$coin_pack->slug = Str::slug($coin_pack->name);
		$coin_pack->cost = 9.9;
        $coin_pack->amount_coins = 10;
        $coin_pack->description = "Información sustancial pack de 9.90";
        $coin_pack->save();

        $coin_pack = new CoinPack();
		$coin_pack->name = 'Pack de 25 coins';
		$coin_pack->slug = Str::slug($coin_pack->name);
        $coin_pack->cost = 20;
        $coin_pack->amount_coins = 25;
        $coin_pack->description = "Información sustancial pack de 19.9";
        $coin_pack->save();

        $coin_pack = new CoinPack();
		$coin_pack->name = 'Pack de 40 coins';
		$coin_pack->slug = Str::slug($coin_pack->name);
        $coin_pack->cost = 29.9;
        $coin_pack->amount_coins = 40;
        $coin_pack->description = "Información sustancial de pack de 29.9";
        $coin_pack->save();

        $coin_pack = new CoinPack();
		$coin_pack->name = 'Pack de 90 coins';
		$coin_pack->slug = Str::slug($coin_pack->name);
        $coin_pack->cost = 49.9;
        $coin_pack->amount_coins = 90;
        $coin_pack->description = "Información sustancial de pack de 49.9";
        $coin_pack->save();
    }
}
