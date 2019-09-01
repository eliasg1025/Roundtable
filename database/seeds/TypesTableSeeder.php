<?php

use Illuminate\Database\Seeder;
use App\Type;
use Carbon\Carbon;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new Type();
        $type->name = "Vendedor-Productor";
		$type->save();
		
		$type = new Type();
        $type->name = "Vendedor-Acopiador";
        $type->save();

        $type = new Type();
        $type->name = "Comprador";
        $type->save();
    }
}
