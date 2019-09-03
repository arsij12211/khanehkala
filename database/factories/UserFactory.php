<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Webpatser\Uuid\Uuid;

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
    $mobile = $faker->regexify('/^[0][9][0-9]{9,9}$/');

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'mobile_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'mobile' => $mobile,
        'mobile_temp' => $mobile,
        'uuid' => Uuid::generate(4)->string,
        'user_ip' => $faker->ipv4,
        'activation_code' => generate_active_code(6),
        'about_me' => $faker->realText(120),
//        'avatar'=>$faker->image(asset('public/assets/img/testPic/Avatar.png')),
        'user_ip' => $faker->ipv4,
        'birthday' => $faker->dateTimeThisDecade('+10 years'),
    ];
});


function generate_active_code($len)
{
    $result = '';
    for ($i = 0; $i < $len; $i++) {
        $result .= mt_rand(0, 9);
    }
    return $result;
}