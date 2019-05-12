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
        $past_competitions = Competition::getNumberOfPastCompetitions($competitions);
        $future_competitions = count($competitions) - $past_competitions;
        $past_contestants = RegisteredContestant::getPastContestants();
        $competitions = Competition::convertDatetimeForView($competitions);

        foreach ($competitions as $key => $competition) {
            $competitions[$key]->leagues = CompetitionLeague::getNames($competition->id);
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

        return redirect('/');
    }
}
