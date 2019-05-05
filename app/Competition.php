<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        "title",
        "location",
        "datetime",
        "registration_starts",
        "registration_ends",
        "image",
        "instructions"
    ];

    /**
     * @param $competitions
     * @return mixed
     * @throws \Exception
     */
    public static function convertDatetimeForView($competitions)
    {
        foreach ($competitions as $competition) {
            $datetime = new Carbon($competition->datetime);
            $competition->datetime = $datetime->format("d/m/Y");
        }

        return $competitions;
    }
}
