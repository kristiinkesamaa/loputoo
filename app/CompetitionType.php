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

    public static function get_by_order($competition_id)
    {
        return DB::table('competition_types')
            ->where('competition_id', '=', $competition_id)
            ->get();
    }
}
