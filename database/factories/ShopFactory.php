<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Shop;
use Faker\Generator as Faker;

$factory->define(App\Models\Shop::class, function (Faker $faker) {
    return [
    'user_id' => $faker->word,
    'name' => $faker->name,
    'description' =>$faker->text
    ];
});
