<?php

use Illuminate\Support\Str;
use topolski\Press\Post;
use Faker\Generator;

$factory->define(Post::class, function (Generator $faker){
    return [
        'identifier' => Str::random(),
        'slug' => Str::slug($faker->sentence),
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'extra' => json_encode(['test' => 'value']),
    ];
});