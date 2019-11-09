<?php

use App\AvalibleTime;
use Illuminate\Database\Seeder;

class AvalibleTimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$avalible_time = new AvalibleTime();
		$avalible_time->daysOfWeek = '12345';
		$avalible_time->startTime = '8:30:00';
		$avalible_time->endTime = '11:30:00';
		$avalible_time->user_id = 1;
		$avalible_time->save();

		$avalible_time = new AvalibleTime();
		$avalible_time->daysOfWeek = '1234';
		$avalible_time->startTime = '14:30:00';
		$avalible_time->endTime = '18:30:00';
		$avalible_time->user_id = 1;
		$avalible_time->save();
    }
}
