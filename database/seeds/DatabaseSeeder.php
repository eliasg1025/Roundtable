<?php

use App\CoinPack;
use App\Plan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypesTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        $this->call(CoinPacksTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(OperationsTableSeeder::class);
		$this->call(StatesTableSeeder::class);
		$this->call(TypeMessagesSeeder::class);

        // Seeders para datos de prueba
        $this->call(UsersTableSeeder::class);
        //$this->call(ImagesTableSeeder::class);
		//$this->call(VideosTableSeeder::class);
		//$this->call(OffersTableSeeder::class);
		//$this->call(OfferCertificationsTableSeeder::class);
		//$this->call(UserCertificationsTableSeeder::class);
		$this->call(RatingsTableSeeder::class);
    }
}
