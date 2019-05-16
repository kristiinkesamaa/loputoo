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
}
