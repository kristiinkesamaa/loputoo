<?php

namespace App\Http\Controllers;

use App\Competition;
use App\CompetitionLeague;
use App\CompetitionType;
use App\RegisteredContestant;
use App\RegisteredTeam;
use Illuminate\Http\Request;

class Groups extends Controller
{
    public function show($id, $league, $type)
    {
        $types = CompetitionType::get_by_competition_id($id);
        $second_person = false;

        foreach ($types as $one_type) {
            if ($one_type->type_id > 2) {
                $second_person = true;
            }
        }

        $type_name = RegisteredTeam::get_long_name($type);

        return view('groups/show_group', [
            'contestants' => RegisteredContestant::get_group($id, $league, $type),
            'second_person' => $second_person,
            'competition_id' => $id,
            'title' => $league . " " . $type_name,
            'address' => $id . '/' . $league . '/' . $type,
            'competition_title' => Competition::get_item_by_id($id, 'title')[0]->title
        ]);
    }

    public function edit($id, $league, $type, $team_id)
    {
        $contestants = RegisteredContestant::get_team($team_id);
        $team_type = RegisteredTeam::get_type($team_id)[0]->id;
        $team_league = RegisteredTeam::get_league($team_id)[0]->id;
        $types = CompetitionType::get_types($id);
        $address = $id . '/' . $league . '/' . $type;
        $second_person = false;

        // Find if competition type is 1 or 2 people
        foreach ($types as $type) {
            if ($type->id > 2) {
                $second_person = true;
            }
        }

        return view('groups/edit', [
            'contestants' => $contestants,
            'competition_types' => $types,
            'competition_leagues' => CompetitionLeague::get_league_names($id),
            'team_type' => $team_type,
            'team_league' => $team_league,
            'second_person' => $second_person,
            'address' => $address,
            'team_id' => $team_id
        ]);
    }

    public function update($id, $league, $type, $team_id, Request $request, RegisteredTeam $registered_team)
    {
        request()->validate([
            "type" => "required",
            "league" => "required",
            "person_1_name" => "required",
            "person_1_email" => "required"
        ]);

        $team = [];
        $team['id'] = $team_id;
        $team['type'] = $request->get('type');
        $team['league'] = $request->get('league');

        $contestants = [];
        $contestants[0]['name'] = $request->get('person_1_name');
        $contestants[0]['email'] = $request->get('person_1_email');

        if (!empty($request->get('person_2_name') && !empty($request->get('person_2_email')))) {
            $contestants[1]['name'] = $request->get('person_2_name');
            $contestants[1]['email'] = $request->get('person_2_email');
        }

        RegisteredTeam::update_contestants($team, $contestants);

        return redirect('/competitions/' . $id . '/' . $league . '/' . $type)->with('updated', true);
    }

    public function destroy($id, $league, $type, $team_id)
    {
        RegisteredTeam::destroy($team_id);

        return redirect('/competitions/' . $id . '/' . $league . '/' . $type)->with('deleted', true);
    }
}
