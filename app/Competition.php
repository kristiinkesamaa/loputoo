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
    public static function convert_datetime_for_view($competitions)
    {
        // Convert database time to more readable format
        foreach ($competitions as $competition) {
            $datetime = new Carbon($competition->datetime);
            $competition->datetime = $datetime->format("d.m.Y");
        }

        return $competitions;
    }

    public static function get_number_of_past_competitions($competitions)
    {
        // Count number of competitions that have taken place
        $now = strtotime(Carbon::now());
        $number = 0;

        foreach ($competitions as $competition) {
            if (strtotime($competition->datetime) < $now) {
                $number++;
            }
        }

        return $number;
    }

    public static function get_item_by_id($id, $item)
    {
        return DB::table('competitions')
            ->where('id', '=', $id)
            ->get($item);
    }

    public static function get_all_future()
    {
        $now = DB::select(DB::raw('SELECT NOW() AS now'))[0]->now;

        return DB::table('competitions')
            ->where('datetime', '>', $now)
            ->orderBy('datetime')
            ->get();
    }

    public static function get_all_past()
    {
        $now = DB::select(DB::raw('SELECT NOW() AS now'))[0]->now;

        return DB::table('competitions')
            ->where('datetime', '<', $now)
            ->orderBy('datetime')
            ->get();
    }
}
