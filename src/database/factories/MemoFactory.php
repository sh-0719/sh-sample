<?php

use Faker\Generator as Faker;

$factory->define(App\Eloquents\Memo::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(App\User::class)->create()->id;
        },
        'content' => $faker->text(15),
    ];
});
