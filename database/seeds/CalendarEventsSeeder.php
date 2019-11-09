<?php

use App\CalendarEvent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CalendarEventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$calendar_event = new CalendarEvent();
		$calendar_event->title = 'Agendamiento con Surandina Peru';
		$calendar_event->date = Carbon::now();
		$calendar_event->user_id = 1;
		$calendar_event->save();
    }
}
