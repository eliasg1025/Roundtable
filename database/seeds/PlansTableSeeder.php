<?php

use Illuminate\Database\Seeder;
use App\Plan;
use Carbon\Carbon;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = new Plan();
        $plan->name = "Free";
        $plan->cost = 0;
		$plan->initial_coins = 0;
		$plan->benefits = json_encode([
			'images' => 3,
			'videos' => 0
		]);
        $plan->save();

        $plan = new Plan();
        $plan->name = "Standard Business";
        $plan->cost = 29;
		$plan->initial_coins = 40;
		$plan->benefits = json_encode([
			'images' => 6,
			'videos' => 1
		]);
        $plan->save();

        $plan = new Plan();
        $plan->name = "Premium Business";
        $plan->cost = 49;
		$plan->initial_coins = 100;
		$plan->benefits = json_encode([
			'images' => 10,
			'videos' => 3
		]);
        $plan->save();
    }
}
