<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CompetitionType extends Model
{
    protected $fillable = [
        "competition_id",
        "type_id"
    ];

    public static function get_by_competition_id($competition_id)
    {
        return DB::table('competition_types')
            ->where('competition_id', '=', $competition_id)
            ->get();
    }

    public static function update_types($request, $competition_id)
    {
        $competition_types_to_delete = [];
        $competition_types_to_insert = [];
        $previous_competition_options = [];
        $selected_competition_options = $request->get("types");
        $competition_types = CompetitionType::get_by_competition_id($competition_id);

        foreach ($competition_types as $competition_type) {
            $previous_competition_options[] = $competition_type->type_id;
        }

        // Find which types to delete
        $competition_types_to_delete = array_merge(
            $competition_types_to_delete,
            array_diff($previous_competition_options, $selected_competition_options));

        // Find which types to insert
        $competition_types_to_insert = array_merge(
            $competition_types_to_insert,
            array_diff($selected_competition_options, $previous_competition_options));

        // Delete unselected types
        foreach ($competition_types_to_delete as $type_id) {
            DB::table('competition_types')
                ->where('competition_id', '=', $competition_id)
                ->where('type_id', '=', $type_id)
                ->delete();
        }

        // Insert selected types
        foreach ($competition_types_to_insert as $type_id) {
            $type = new CompetitionType();

            $type->competition_id = $competition_id;
            $type->type_id = $type_id;

            $type->save();
        }
    }

    public static function get_types($competition_id)
    {
        return DB::table('competition_types')
            ->leftJoin('types', 'competition_types.type_id', '=', 'types.id')
            ->where('competition_id', '=', $competition_id)
            ->orderBy('types.id', 'asc')
            ->get();
    }

    public static function add_short_names($types)
    {
        foreach ($types as $key => $type) {

            // Add short names to types
            if ($type->type_id === 1) {
                $types[$key]->short_name = "NÜ";
            } elseif ($type->type_id === 2) {
                $types[$key]->short_name = "MÜ";
            } elseif ($type->type_id === 3) {
                $types[$key]->short_name = "NP";
            } elseif ($type->type_id === 4) {
                $types[$key]->short_name = "MP";
            } elseif ($type->type_id === 5) {
                $types[$key]->short_name = "SP";
            }
        }

        return $types;
    }
}
