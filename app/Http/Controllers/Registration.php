<?php

namespace App\Http\Controllers;

use App\RegisteredContestant;
use App\RegisteredTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Registration extends Controller
{

    public function register(Request $request)
    {
        // Make sure required fields are filled
        request()->validate([
            "type" => "required",
            "person_1_name" => "required",
            "person_1_email" => "required",
            "person_2_name" => "required_if:type,>,2",
            "person_2_email" => "required_if:type,>,2"
        ]);

        $type_id = $request->get("type");

        // Save new team
        $team = new RegisteredTeam();

        $team->competition_id = $request->id;
        $team->type_id = $type_id;

        $team->save();

        // Save new registered contestant
        $contestant1 = new RegisteredContestant();

        $contestant1->competition_id = $request->id;
        $contestant1->team_id = $team->id;
        $contestant1->name = $request->get("person_1_name");
        $contestant1->email = $request->get("person_1_email");

        $contestant1->save();

        // If competition type is 2 people then save other contestant
        if ($type_id > 2) {
            $contestant2 = new RegisteredContestant();

            $contestant2->competition_id = $request->id;
            $contestant2->team_id = $team->id;
            $contestant2->name = $request->get("person_2_name");
            $contestant2->email = $request->get("person_2_email");

            $contestant2->save();
        }

        return redirect('/competitions/' . $request->id);
    }

    public function confirm(Request $request)
    {
        // Make sure required fields are filled
        request()->validate([
            "confirmed" => "required"
        ]);

        dd($request);

        DB::table('registered_teams')
            ->whereIn('id', $request->get("confirmed"))
            ->update(['confirmed' => 1]);
    }
}