<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\News::class, function (Faker $faker) {
    $faker->addProvider(new \DavidBadura\FakerMarkdownGenerator\FakerProvider($faker));

    return [
        'author_id' => factory(\App\User::class),
        'photo_url' => $faker->imageUrl(300,200),
        'title' => $faker->bs,
        'body' => $faker->markdown(),

        'published_at' => null
    ];
});

$factory->state(\App\News::class, 'published', ['published_at' => now()]);
