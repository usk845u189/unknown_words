<?php

use Faker\Generator as Faker;
use App\Models\Word;

$factory->define(Word::class, function (Faker $faker) {
    return [
        'word'=>$faker->text(255), 
        'detail'=>$faker->text(255), 
        'body' => $faker->realText(500), 
    ];
});