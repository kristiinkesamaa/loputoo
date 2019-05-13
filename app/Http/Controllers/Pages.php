<?php

namespace App\Http\Controllers;

use App\Competition;
use App\CompetitionLeague;
use App\RegisteredContestant;

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
}
