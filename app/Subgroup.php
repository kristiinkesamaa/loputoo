<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subgroup extends Model
{
    public static function get()
    {
        return DB::table('subgroups')
            ->leftJoin('registered_teams', 'subgroup_id', '=', 'subgroups.id')
            ->leftJoin('types', 'registered_teams.type_id', '=', 'types.id')
            ->leftJoin('leagues', 'registered_teams.league_id', '=', 'leagues.id')
            ->groupBy('subgroups.id')
            ->get([
                'subgroups.*',
                'types.name AS type_name',
                'leagues.name AS league_name'
            ]);
    }
}
