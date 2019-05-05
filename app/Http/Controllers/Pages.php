<?php

namespace App\Http\Controllers;

use App\Competition;
use Illuminate\Http\Request;

class Pages extends Controller
{
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

    public function test()
    {
        return view('/test');
    }
}
