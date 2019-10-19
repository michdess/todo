<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Todo;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Todo::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence,
        'due' => Carbon::now()->addWeek(),
    ];
});
