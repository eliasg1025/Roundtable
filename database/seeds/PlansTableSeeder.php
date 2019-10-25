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
		$plan->slug = Str::slug($plan->name);
		$plan->is_best = false;
        $plan->cost = 0;
		$plan->initial_coins = 0;
		$plan->images = 3;
		$plan->videos = 0;
		$plan->description = "Esto de plan gratis";
        $plan->save();

        $plan = new Plan();
		$plan->name = "Standard";
		$plan->slug = Str::slug($plan->name);
		$plan->is_best = false;
        $plan->cost = 29.9;
		$plan->initial_coins = 40;
		$plan->images = 8;
		$plan->videos = 1;
		$plan->description = "Esto de plan estandar";
        $plan->save();

        $plan = new Plan();
		$plan->name = "Premium";
		$plan->slug = Str::slug($plan->name);
		$plan->is_best = true;
        $plan->cost = 49.9;
		$plan->initial_coins = 100;
		$plan->images = 20;
		$plan->videos = 3;
		$plan->description = "Esto de plan Premium";
        $plan->save();
    }
}
