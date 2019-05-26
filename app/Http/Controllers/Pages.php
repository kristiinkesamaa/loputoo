<?php

namespace App\Http\Controllers;

use App\Competition;
use App\CompetitionLeague;
use App\CompetitionType;
use App\Queue;
use App\RegisteredContestant;
use App\RegisteredTeam;
use App\Subgroup;
use Illuminate\Http\Request;

class Pages extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $competitions = Competition::all();
        $past_competitions = Competition::get_number_of_past_competitions($competitions);
        $future_competitions = count($competitions) - $past_competitions;
        $past_contestants = RegisteredContestant::get_past_contestants();
        $competitions = Competition::convert_datetime_for_view($competitions);

        foreach ($competitions as $key => $competition) {
            $competitions[$key]->leagues = CompetitionLeague::get_league_names($competition->id);
        }

        return view('index', [
            'competitions' => $competitions,
            'past_competitions' => $past_competitions,
            'future_competitions' => $future_competitions,
            'past_contestants' => $past_contestants
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->back();
    }

    public function add_subgroup(Request $request)
    {
        // Make sure required fields are filled
        request()->validate([
            "title" => "required",
            "teams" => "required"
        ]);

        $team_ids = $request->get("teams");

        // Create new subgroup
        $subgroup = new Subgroup();

        $subgroup->title = $request->get("title");
        $subgroup->number_of_teams = count($team_ids);

        $subgroup->save();

        // Update subgroup ids in teams that belong to it
        $number = 1;
        foreach ($team_ids as $team_id) {
            RegisteredTeam::update_subgroup_id($team_id, $subgroup->id, $number);
            $number++;
        }

        return back()->with("subgroup_added", true);
    }

    public function show_subgroup($id, $subgroup_id)
    {
        $subgroup = Subgroup::get_by_id($subgroup_id)[0];
        $subgroup_contestants = CompetitionType::add_short_names(Subgroup::get_all_by_id($subgroup_id));
        $second_person = false;

        // Find if competition type is 1 or 2 people
        foreach ($subgroup_contestants as $contestant) {
            if ($contestant->type_id > 2) {
                $second_person = true;
            }
        }

        $team_ids = RegisteredTeam::find_team_ids_for_queue($subgroup_contestants, $subgroup->number_of_teams);

        return view('competitions/subgroup', [
            'subgroup' => $subgroup,
            'subgroup_contestants' => $subgroup_contestants,
            'title' => $subgroup_contestants[0]->league_name . ' ' . $subgroup_contestants[0]->short_name . ' - ' . $subgroup->title,
            'competition_id' => $id,
            'second_person' => $second_person,
            'team_ids' => $team_ids
        ]);
    }

    public function queue($id, Request $request)
    {
        $queue_number = Queue::get_highest_queue_number_by_competition_id($id);

        if (empty($queue_number)) {
            $queue_number = 1;
        } else {
            $queue_number++;
        }

        $queue = new Queue();

        $queue->team_1_id = $request->get('team_1_id');
        $queue->team_2_id = $request->get('team_2_id');
        $queue->queue_number = $queue_number;

        $queue->save();

        return back()->with("queue_added", true);
    }


}
