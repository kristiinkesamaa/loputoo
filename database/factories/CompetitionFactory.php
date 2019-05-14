<?php

use App\Competition;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Model;

$factory->define(Competition::class, function () {
    return [
        "id" => 1,
        "title" => "pealkiri",
        "location" => "koht",
        "datetime" => "2019-05-24 00:00:00",
        "registration_starts" => "2019-05-11",
        "registration_ends" => "2019-05-23",
        "image" => "image.png",
        "instructions" => "instructions.pdf",
        "created_at" => "2019-05-11 00:00:00",
        "updated_at" => "2019-05-11 00:00:00"
    ];
});
