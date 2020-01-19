<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Laratube\Models\Channel;
use Laratube\User;

$factory->define(Channel::class, function (Faker $faker) {

    $user = factory(User::class)->create();
    return [
        'name' => $user->name,
        'user_id' => $user->id,
        'description' => $faker->sentence('600')
    ];
});
