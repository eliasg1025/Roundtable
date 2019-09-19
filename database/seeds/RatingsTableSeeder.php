<?php

use App\Rating;
use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$rating = new Rating();
		$rating->value = 4;
		$rating->user_id = 1;
		$rating->save();

		$rating = new Rating();
		$rating->value = 4;
		$rating->user_id = 1;
		$rating->save();

		$rating = new Rating();
		$rating->value = 4;
		$rating->user_id = 1;
		$rating->save();

		$rating = new Rating();
		$rating->value = 3;
		$rating->user_id = 1;
		$rating->save();

		$rating = new Rating();
		$rating->value = 5;
		$rating->user_id = 1;
		$rating->save();

		$rating = new Rating();
		$rating->value = 5;
		$rating->user_id = 1;
		$rating->save();

		$rating = new Rating();
		$rating->value = 4;
		$rating->user_id = 1;
		$rating->save();

		$rating = new Rating();
		$rating->value = 3;
		$rating->user_id = 1;
		$rating->save();

		$rating = new Rating();
		$rating->value = 2;
		$rating->user_id = 1;
		$rating->save();

		$rating = new Rating();
		$rating->value = 3;
		$rating->user_id = 2;
		$rating->save();

		$rating = new Rating();
		$rating->value = 3;
		$rating->user_id = 3;
		$rating->save();

		$rating = new Rating();
		$rating->value = 3;
		$rating->user_id = 4;
		$rating->save();

		$rating = new Rating();
		$rating->value = 3;
		$rating->user_id = 5;
		$rating->save();
    }
}
