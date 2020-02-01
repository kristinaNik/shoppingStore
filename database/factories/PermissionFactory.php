<?php
use Faker\Generator as Faker;

$factory->define(\App\Permission::class, function (Faker $faker) {;
    return [
        [
            'name' => 'view-user',
            'display_name' => 'view user',
            'description' => 'View All Users',
        ],
//        [
//            'name' => 'create-user',
//            'display_name' => 'create user',
//            'description' => 'Create  Users',
//
//        ]
    ];

});
