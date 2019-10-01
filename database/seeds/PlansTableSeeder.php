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
		$plan->is_best = false;
        $plan->cost = 0;
		$plan->initial_coins = 0;
		$plan->images = 3;
		$plan->videos = 0;
        $plan->save();

        $plan = new Plan();
		$plan->name = "Standard Business";
		$plan->is_best = false;
        $plan->cost = 29;
		$plan->initial_coins = 40;
		$plan->images = 6;
		$plan->videos = 1;
        $plan->save();

        $plan = new Plan();
		$plan->name = "Premium Business";
		$plan->is_best = true;
        $plan->cost = 49;
		$plan->initial_coins = 100;
		$plan->images = 10;
		$plan->videos = 3;
        $plan->save();
    }
}
