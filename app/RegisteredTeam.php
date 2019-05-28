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

    public static function get_long_name($short_type_name)
    {
        if ($short_type_name === "NÜ") {
            $type_name = "naisüksik";
        } elseif ($short_type_name === "MÜ") {
            $type_name = "meesüksik";
        } elseif ($short_type_name === "NP") {
            $type_name = "naispaar";
        } elseif ($short_type_name === "MP") {
            $type_name = "meespaar";
        } elseif ($short_type_name === "SP") {
            $type_name = "segapaar";
        }

        return $type_name;
    }

    public static function update_subgroup_id($team_id, $id, $number)
    {
        DB::table('registered_teams')
            ->where('id', '=', $team_id)
            ->update(['subgroup_id' => $id, 'subgroup_order' => $number]);
    }

    public static function find_team_ids_for_queue($subgroup_contestants, $number_of_teams)
    {
        if ($number_of_teams === 3) {

            $team_ids = [0, 0, 0];
            foreach ($subgroup_contestants as $contestant) {
                if ($contestant->subgroup_order === 1) {
                    $team_ids[1] = $contestant->team_id;
                } elseif ($contestant->subgroup_order === 2) {
                    $team_ids[2] = $contestant->team_id;
                } elseif ($contestant->subgroup_order === 3) {
                    $team_ids[3] = $contestant->team_id;
                }
            }

        } elseif ($number_of_teams === 4) {

            $team_ids = [0, 0, 0, 0];
            foreach ($subgroup_contestants as $contestant) {
                if ($contestant->subgroup_order === 1) {
                    $team_ids[1] = $contestant->team_id;
                } elseif ($contestant->subgroup_order === 2) {
                    $team_ids[2] = $contestant->team_id;
                } elseif ($contestant->subgroup_order === 3) {
                    $team_ids[3] = $contestant->team_id;
                } elseif ($contestant->subgroup_order === 4) {
                    $team_ids[4] = $contestant->team_id;
                }
            }

        } elseif ($number_of_teams === 5) {

            $team_ids = [0, 0, 0, 0, 0];
            foreach ($subgroup_contestants as $contestant) {
                if ($contestant->subgroup_order === 1) {
                    $team_ids[1] = $contestant->team_id;
                } elseif ($contestant->subgroup_order === 2) {
                    $team_ids[2] = $contestant->team_id;
                } elseif ($contestant->subgroup_order === 3) {
                    $team_ids[3] = $contestant->team_id;
                } elseif ($contestant->subgroup_order === 4) {
                    $team_ids[4] = $contestant->team_id;
                } elseif ($contestant->subgroup_order === 5) {
                    $team_ids[5] = $contestant->team_id;
                }
            }

        }

        return $team_ids;
    }

    public static function get_by_subgroup($subgroup_id)
    {
        $teams = DB::table('registered_teams')
            ->where('subgroup_id', '=', $subgroup_id)
            ->get();

        $team_ids = [];

        foreach ($teams as $team) {
            $team_ids[] = $team->id;
        }

        return $team_ids;
    }

    public static function remove_from_subgroup($subgroup_id)
    {
        DB::table('registered_teams')
            ->where('subgroup_id', '=', $subgroup_id)
            ->update(['subgroup_id' => 0, 'subgroup_order' => 0]);
    }

}
