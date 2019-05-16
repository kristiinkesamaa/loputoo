<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CompetitionLeague extends Model
{
    protected $fillable = [
        "competition_id",
        "league_id"
    ];

    public static function get_by_competition_id($competition_id)
    {
        return DB::table('competition_leagues')
            ->where('competition_id', '=', $competition_id)
            ->get();
    }

    public static function update_leagues($request, $competition_id)
    {
        $competition_leagues_to_delete = [];
        $competition_leagues_to_insert = [];
        $previous_competition_options = [];
        $selected_competition_options = $request->get("leagues");
        $competition_leagues = CompetitionLeague::get_by_competition_id($competition_id);

        foreach ($competition_leagues as $competition_league) {
            $previous_competition_options[] = $competition_league->league_id;
        }

        // Find which leagues to delete
        $competition_leagues_to_delete = array_merge(
            $competition_leagues_to_delete,
            array_diff($previous_competition_options, $selected_competition_options));

        // Find which leagues to insert
        $competition_leagues_to_insert = array_merge(
            $competition_leagues_to_insert,
            array_diff($selected_competition_options, $previous_competition_options));

        // Delete unselected leagues
        foreach ($competition_leagues_to_delete as $league_id) {
            DB::table('competition_leagues')
                ->where('competition_id', '=', $competition_id)
                ->where('league_id', '=', $league_id)
                ->delete();
        }

        // Insert selected leagues
        foreach ($competition_leagues_to_insert as $league_id) {
            $league = new CompetitionLeague();

            $league->competition_id = $competition_id;
            $league->league_id = $league_id;

            $league->save();
        }
    }

    public static function get_league_names($competition_id)
    {
        return DB::table('competition_leagues')
            ->leftJoin('leagues', 'competition_leagues.league_id', '=', 'leagues.id')
            ->where('competition_id', '=', $competition_id)
            ->orderBy('leagues.id', 'asc')
            ->get(['leagues.id', 'name']);
    }
}
