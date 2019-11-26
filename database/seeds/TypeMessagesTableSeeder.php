<?php

use App\TypeMessage;
use Illuminate\Database\Seeder;

class TypeMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_message = new TypeMessage();
		$type_message->name = 'transaction';
		$type_message->picture = '\img\notification-icons\star-1.svg';
		$type_message->save();

		$type_message = new TypeMessage();
		$type_message->name = 'sucess';
		$type_message->picture = '\img\notification-icons\success.svg';
		$type_message->save();

		$type_message = new TypeMessage();
		$type_message->name = 'meet';
		$type_message->picture = '\img\notification-icons\calendar-5.svg';
		$type_message->save();

		$type_message = new TypeMessage();
		$type_message->name = 'welcome';
		$type_message->picture = '\img\notification-icons\users.svg';
		$type_message->save();
    }
}
