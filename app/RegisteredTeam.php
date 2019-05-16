<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegisteredTeam extends Model
{
    public static function confirm(\Illuminate\Http\Request $request)
    {
        DB::table('registered_teams')
            ->whereIn('id', $request->get("confirm"))
            ->update(['confirmed' => 1]);
    }

    public static function get_type($id)
    {
        return DB::table('registered_teams')
            ->leftJoin('types', 'registered_teams.type_id', '=', 'types.id')
            ->where('registered_teams.id', '=', $id)
            ->get('types.id');
    }

    public static function get_league($id)
    {
        return DB::table('registered_teams')
            ->leftJoin('leagues', 'registered_teams.league_id', '=', 'leagues.id')
            ->where('registered_teams.id', '=', $id)
            ->get('leagues.id');
    }

    public static function get_by_id($id)
    {
        return DB::table('registered_teams')
            ->where('registered_teams.id', '=', $id)
            ->get();
    }

    public static function update_contestants($team, $contestants)
    {
        DB::table('registered_teams')
            ->where('id', $team['id'])
            ->update(['type_id' => $team['type'], 'league_id' => $team['league']]);

        $contestant_ids = DB::table('registered_contestants')
            ->leftJoin('registered_teams', 'registered_teams.id', '=', 'team_id')
            ->where('registered_teams.id', '=', $team['id'])
            ->get('registered_contestants.id');

        foreach ($contestants as $key => $contestant) {
            DB::table('registered_contestants')
                ->where('id', $contestant_ids[$key]->id)
                ->update(['name' => $contestant['name'], 'email' => $contestant['email']]);
        }
    }
}
