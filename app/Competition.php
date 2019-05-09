<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getLeagues($competition_id)
    {
        return DB::table('competition_leagues')
            ->leftJoin('leagues', 'competition_leagues.league_id', '=', 'leagues.id')
            ->where('competition_id', '=', $competition_id)
            ->get();
    }

    public static function getTypes($competition_id)
    {
        return DB::table('competition_types')
            ->leftJoin('types', 'competition_types.type_id', '=', 'types.id')
            ->where('competition_id', '=', $competition_id)
            ->get();
    }
}
