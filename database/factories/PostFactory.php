<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'user_id' => function () {
        	return factory('App\User')->create()->id;
        },
        'group_id' => function () {
        	return factory('App\Group')->create()->id;
        }
    ];
});
