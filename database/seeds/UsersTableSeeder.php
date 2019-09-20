<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Surandina Peru',
            'email' => 'contacto@surandinaperu.pe',
            'password' => bcrypt('12345678'),
            'ruc' => '20602926061',
            'legal_registration' => '20602926061',
            'phone' => '957181383',
            'profile_img' => '/img/empresa/empresa1-logo.png',
            'cover_img' => '/img/empresa/empresa1/productos/producto1.jpg',
            'description' => 'Producimos, cosechamos y empacamos alimentos 100% orgánicos siguiendo estrictos estándares de calidad, inocuidad y seguridad, en armonía con el medio ambiente y convirtiendo pequeñas comunidades en polos de desarrollo. De la costa y sierra del norte del Perú para el mundo.',
            'coins' => 40,
            'views' => 60,
            'type_id' => 1,
        ])->categories()->attach([1, 2, 3]);

        App\User::create([
            'name' => 'Empresa de prueba 1',
            'email' => 'empresa1@prueba1.com',
            'password' => bcrypt('12345678'),
            'ruc' => '20602926062',
            'legal_registration' => '20602926062',
            'phone' => '957181384',
            'profile_img' => '/img/empresa/empresa1-logo.png',
            'cover_img' => '/img/empresa/empresa1/productos/producto1.jpg',
            'description' => 'Producimos, cosechamos y empacamos alimentos 100% orgánicos siguiendo estrictos estándares de calidad, inocuidad y seguridad, en armonía con el medio ambiente y convirtiendo pequeñas comunidades en polos de desarrollo. De la costa y sierra del norte del Perú para el mundo.',
            'coins' => 50,
            'views' => 50,
            'type_id' => 2,
        ])->categories()->attach([5, 6, 7]);

        App\User::create([
            'name' => 'Empresa de prueba 2',
            'email' => 'empresa2@prueba.com',
            'password' => bcrypt('12345678'),
            'ruc' => '20602926063',
            'legal_registration' => '20602926062',
            'phone' => '957181384',
            'profile_img' => '/img/empresa/empresa1-logo.png',
            'cover_img' => '/img/empresa/empresa1/productos/producto1.jpg',
            'description' => 'Producimos, cosechamos y empacamos alimentos 100% orgánicos siguiendo estrictos estándares de calidad, inocuidad y seguridad, en armonía con el medio ambiente y convirtiendo pequeñas comunidades en polos de desarrollo. De la costa y sierra del norte del Perú para el mundo.',
            'coins' => 50,
            'views' => 50,
            'type_id' => 2,
        ])->categories()->attach([1, 6, 10]);

        App\User::create([
            'name' => 'Empresa de prueba 3',
            'email' => 'empresa3@prueba.com',
            'password' => bcrypt('12345678'),
            'ruc' => '20602926064',
            'legal_registration' => '20602926062',
            'phone' => '957181384',
            'profile_img' => '/img/empresa/empresa1-logo.png',
            'cover_img' => '/img/empresa/empresa1/productos/producto1.jpg',
            'description' => 'Producimos, cosechamos y empacamos alimentos 100% orgánicos siguiendo estrictos estándares de calidad, inocuidad y seguridad, en armonía con el medio ambiente y convirtiendo pequeñas comunidades en polos de desarrollo. De la costa y sierra del norte del Perú para el mundo.',
            'coins' => 50,
            'views' => 50,
            'type_id' => 2,
        ])->categories()->attach([5, 1, 2]);

        App\User::create([
            'name' => 'Empresa de prueba 4',
            'email' => 'empresa4@prueba.com',
            'password' => bcrypt('12345678'),
            'ruc' => '20602926065',
            'legal_registration' => '20602926062',
            'phone' => '957181384',
            'profile_img' => '/img/empresa/empresa1-logo.png',
            'cover_img' => '/img/empresa/empresa1/productos/producto1.jpg',
            'description' => 'Producimos, cosechamos y empacamos alimentos 100% orgánicos siguiendo estrictos estándares de calidad, inocuidad y seguridad, en armonía con el medio ambiente y convirtiendo pequeñas comunidades en polos de desarrollo. De la costa y sierra del norte del Perú para el mundo.',
            'coins' => 50,
            'views' => 50,
            'type_id' => 3,
        ])->categories()->attach([8, 11, 7]);
    }
}
