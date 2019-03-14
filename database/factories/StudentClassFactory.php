<?php

use App\User;
use App\Classtype;
use App\StudentClass;
use Faker\Generator as Faker;

$factory->define(StudentClass::class, function (Faker $faker) {

    return [
        'name'        => $faker->word,
        'class_id'    => function () {
            return factory(Classtype::class)->create()->id;
        },
        'description' => $faker->sentence,
        'creator_id'  => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
