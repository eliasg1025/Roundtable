<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
		'name' => $faker->company,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        //
        'ruc' => $faker->numerify('###########'),
        'legal_registration' => $faker->numerify('############'),
        'phone' => $faker->phoneNumber,
        /* 'profile_img' => $faker->optional($weigth=0.5)->imageUrl($width=200, $height=200),
        'cover_img' => $faker->optinal($weigth=0.5)->imageUrl($width=1300, $height=400), */
        'address' => $faker->address,
        'description' => $faker->optional($weigth=0.7)->text(200),
        'coins' => $faker->randomElement([20, 40, 50]),
        'rating' => $faker->randomElement([1, 2, 3, 4, 5]),
        'views' => $faker->randomElement([20, 40, 50]),
        'type_id' => $faker->randomElement([1, 2, 3]),
    ];
});
