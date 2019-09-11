<?php

use App\UserCertfication;
use Illuminate\Database\Seeder;

class UserCertificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$user_certification = new UserCertfication();
		$user_certification->title = 'ISO 14001:2015';
		$user_certification->description = 'Certificado de prueba para la empresa surandina';
		$user_certification->url = 'http://sgc.itmexicali.edu.mx/formatos/DOCUMENTOS%20EXTERNOS%20OK/Norma%20ISO%2014001_2015%20/ISO_14001_2015%20Requisitos.PDF';
		$user_certification->user_id = 30;
		$user_certification->save();

		$user_certification = new UserCertfication();
		$user_certification->title = 'HACCP';
		$user_certification->description = 'Certificado de prueba para la empresa surandina';
		$user_certification->url = 'https://www.senasa.gob.pe/senasa/descargasarchivos/2014/12/HACCP.pdf';
		$user_certification->user_id = 30;
		$user_certification->save();
    }
}
