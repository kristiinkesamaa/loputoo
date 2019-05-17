<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegisteredContestant extends Model
{
    protected $fillable = [
        "name",
        "email"
    ];

    public static function get_unconfirmed_by_competition_id($competition_id)
    {
        // Get all contestants who haven't been confirmed by admin
        return DB::table('registered_contestants')
            ->leftJoin('registered_teams', 'team_id', '=', 'registered_teams.id')
            ->leftJoin('types', 'type_id', '=', 'types.id')
            ->leftJoin('leagues', 'league_id', '=', 'leagues.id')
            ->where('registered_teams.competition_id', '=', $competition_id)
            ->where('confirmed', '=', 0)
            ->get([
                'registered_contestants.*',
                'registered_teams.*',
                'types.name AS type_name',
                'leagues.name AS league_name'
            ]);
    }

    public static function get_past_contestants()
    {

        return DB::table('registered_contestants')
            ->leftJoin('registered_teams', 'team_id', '=', 'registered_teams.id')
            ->leftJoin('competitions', 'registered_teams.competition_id', '=', 'competitions.id')
            ->where('competitions.datetime', '<', DB::raw('NOW()'))
            ->where('registered_teams.confirmed', '=', 1)
            ->count('registered_contestants.id');
    }

    public static function get_by_competition_id($competition_id)
    {
        // Get all contestants who have been confirmed by admin
        return DB::table('registered_contestants')
            ->leftJoin('registered_teams', 'team_id', '=', 'registered_teams.id')
            ->leftJoin('types', 'type_id', '=', 'types.id')
            ->leftJoin('leagues', 'league_id', '=', 'leagues.id')
            ->where('registered_teams.competition_id', '=', $competition_id)
            ->where('confirmed', '=', 1)
            ->get([
                'registered_contestants.*',
                'registered_teams.*',
                'types.name AS type_name',
                'leagues.name AS league_name'
            ]);
    }

    public static function get_group($competition_id, $league_name, $short_type_name)
    {
        // Find long type name
        $type_name = RegisteredTeam::get_long_name($short_type_name);

        // Get all contestants by competition_id, league name and type name who have been confirmed by admin
        return DB::table('registered_contestants')
            ->leftJoin('registered_teams', 'team_id', '=', 'registered_teams.id')
            ->leftJoin('types', 'type_id', '=', 'types.id')
            ->leftJoin('leagues', 'league_id', '=', 'leagues.id')
            ->where('registered_teams.competition_id', '=', $competition_id)
            ->where('leagues.name', '=', $league_name)
            ->where('types.name', '=', $type_name)
            ->where('confirmed', '=', 1)
            ->get([
                'registered_contestants.*',
                'registered_teams.*',
                'types.name AS type_name',
                'leagues.name AS league_name'
            ]);
    }

    public static function get_team($team_id)
    {
        return DB::table('registered_contestants')
            ->leftJoin('registered_teams', 'team_id', '=', 'registered_teams.id')
            ->leftJoin('types', 'type_id', '=', 'types.id')
            ->leftJoin('leagues', 'league_id', '=', 'leagues.id')
            ->where('registered_teams.id', '=', $team_id)
            ->where('confirmed', '=', 1)
            ->get([
                'registered_contestants.*',
                'registered_teams.*',
                'types.name AS type_name',
                'leagues.name AS league_name'
            ]);
    }
}
