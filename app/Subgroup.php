<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subgroup extends Model
{
    public static function get($competition_id)
    {
        return DB::table('subgroups')
            ->leftJoin('registered_teams', 'subgroup_id', '=', 'subgroups.id')
            ->leftJoin('types', 'registered_teams.type_id', '=', 'types.id')
            ->leftJoin('leagues', 'registered_teams.league_id', '=', 'leagues.id')
            ->where('competition_id', '=', $competition_id)
            ->groupBy('subgroups.id')
            ->get([
                'subgroups.*',
                'types.name AS type_name',
                'types.id AS type_id',
                'leagues.name AS league_name'
            ]);
    }

    public static function get_all_by_id($subgroup_id)
    {
        return DB::table('subgroups')
            ->leftJoin('registered_teams', 'subgroup_id', '=', 'subgroups.id')
            ->leftJoin('registered_contestants', 'team_id', '=', 'registered_teams.id')
            ->leftJoin('leagues', 'league_id', '=', 'leagues.id')
            ->leftJoin('types', 'type_id', '=', 'types.id')
            ->where('subgroups.id', '=', $subgroup_id)
            ->get([
                'subgroups.*',
                'registered_teams.*',
                'registered_contestants.*',
                'types.name AS type_name',
                'leagues.name AS league_name',
            ]);
    }

    public static function get_by_id($subgroup_id)
    {
        return DB::table('subgroups')
            ->where('subgroups.id', '=', $subgroup_id)
            ->get();
    }
}
