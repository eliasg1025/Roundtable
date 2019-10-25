<?php

use App\Operation;
use Illuminate\Database\Seeder;

class OperationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operation = new Operation();
        $operation->name = 'Publicar imagenes';
        $operation->coins_cost = 1;
        $operation->save();

        $operation = new Operation();
        $operation->name = 'Publicar ofertas';
        $operation->coins_cost = 5;
        $operation->save();

        $operation = new Operation();
        $operation->name = 'Publicar certificados de empresa';
        $operation->coins_cost = 3;
        $operation->save();

        $operation = new Operation();
        $operation->name = 'Agendar reuniones';
        $operation->coins_cost = 10;
        $operation->save();
    }
}
