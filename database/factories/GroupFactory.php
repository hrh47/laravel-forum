<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Group;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'user_id' => function () {
        	return factory('App\User')->create()->id;
        }
    ];
});
