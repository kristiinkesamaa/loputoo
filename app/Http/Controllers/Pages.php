<?php

namespace App\Http\Controllers;

use App\Competition;
use App\RegisteredContestant;
use App\RegisteredTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Pages extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $competitions = Competition::convertDatetimeForView(Competition::all());

        return view('index', [
            'competitions' => $competitions
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}
