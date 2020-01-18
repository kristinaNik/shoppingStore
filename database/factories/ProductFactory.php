<?php
/**
 * Created by PhpStorm.
 * User: kristina
 * Date: 6/1/19
 * Time: 12:45 PM
 */
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {;
    return [
        'image' => $faker->image('public/storage/images',400,300, null, false),
        'title' => $faker->word,
        'description' => $faker->text,
        'price' => $faker->randomFloat(2, 0, 1)
    ];
});
