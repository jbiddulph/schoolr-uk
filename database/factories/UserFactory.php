<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'user_type' => 'seeker',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'user_id' => App\User::all()->random()->id,
        'cname'=>$name=$faker->company,
        'slug'=>Str::slug($name),
        'address'=>$faker->address,
        'telephone'=>$faker->phoneNumber,
        'website'=>$faker->domainName,
        'logo'=>'logo/company-logo.png',
        'cover_photo'=>'cover/pier_header.png',
        'slogan'=>'letting agents',
        'description'=>$faker->paragraph(rand(2,10))
    ];
});

$factory->define(App\Property::class, function (Faker $faker) {
    return [
        'user_id' => App\User::all()->random()->id,
        'company_id'=>App\Company::all()->random()->id,
        'propname'=>$prop_name=$faker->text(60),
        'slug'=>Str::slug($prop_name),
        'propcost'=>'399,000',
        'proptype_id'=>'1',
        'propimage'=>'property/pantiles.jpg',
        'address'=>$faker->address,
        'town'=>$faker->city,
        'postcode'=>$faker->postcode,
        'latitude'=>$faker->latitude,
        'longitude'=>$faker->longitude,
        'description'=>$faker->paragraph(rand(2,10)),
        'floorplan'=>'floorplan/penfold.jpg',
        'brochure'=>'brochure/penfold.pdf',
        'category_id'=>rand(1,5),
        'is_live'=>'1',
        'description'=>$faker->paragraph(rand(2,10)),
        'last_date'=>$faker->dateTime
    ];
});

