<?php

use App\OfferCertfication;
use Illuminate\Database\Seeder;

class OfferCertificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$offer_certification = new OfferCertfication();
		$offer_certification->title = 'ISO 14001:2015';
		$offer_certification->description = 'Certificado de prueba para la empresa surandina (Bananos)';
		$offer_certification->url = 'http://sgc.itmexicali.edu.mx/formatos/DOCUMENTOS%20EXTERNOS%20OK/Norma%20ISO%2014001_2015%20/ISO_14001_2015%20Requisitos.PDF';
		$offer_certification->offer_id = 2;
		$offer_certification->save();

		$offer_certification = new OfferCertfication();
		$offer_certification->title = 'HACCP';
		$offer_certification->description = 'Certificado de prueba para la empresa surandina (Bananos)';
		$offer_certification->url = 'https://www.senasa.gob.pe/senasa/descargasarchivos/2014/12/HACCP.pdf';
		$offer_certification->offer_id = 2;
		$offer_certification->save();

		$offer_certification = new OfferCertfication();
		$offer_certification->title = 'ISO 14001:2015';
		$offer_certification->description = 'Certificado de prueba para la empresa surandina (Arandanos)';
		$offer_certification->url = 'http://sgc.itmexicali.edu.mx/formatos/DOCUMENTOS%20EXTERNOS%20OK/Norma%20ISO%2014001_2015%20/ISO_14001_2015%20Requisitos.PDF';
		$offer_certification->offer_id = 1;
		$offer_certification->save();

		$offer_certification = new OfferCertfication();
		$offer_certification->title = 'ISO 14001:2015';
		$offer_certification->description = 'Certificado de prueba para la empresa surandina (Arandanos)';
		$offer_certification->url = 'http://sgc.itmexicali.edu.mx/formatos/DOCUMENTOS%20EXTERNOS%20OK/Norma%20ISO%2014001_2015%20/ISO_14001_2015%20Requisitos.PDF';
		$offer_certification->offer_id = 1;
		$offer_certification->save();

		$offer_certification = new OfferCertfication();
		$offer_certification->title = 'ISO 14001:2015';
		$offer_certification->description = 'Certificado de prueba para la empresa surandina (Arandanos)';
		$offer_certification->url = 'http://sgc.itmexicali.edu.mx/formatos/DOCUMENTOS%20EXTERNOS%20OK/Norma%20ISO%2014001_2015%20/ISO_14001_2015%20Requisitos.PDF';
		$offer_certification->offer_id = 1;
		$offer_certification->save();
    }
}
