<?php

use App\State;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $state = new State();
        $state->name = 'Pendiente';
        $state->save();

        $state = new State();
        $state->name = 'Cancelado';
        $state->save();

        $state = new State();
        $state->name = 'Agendado';
        $state->save();

        $state = new State();
        $state->name = 'Exitoso';
        $state->save();
    }
}
