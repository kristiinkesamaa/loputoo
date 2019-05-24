<?php

namespace App\Http\Controllers;

use App\Competition;
use App\CompetitionLeague;
use App\CompetitionType;
use App\RegisteredContestant;
use App\Subgroup;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Competitions extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index()
    {
        $competitions = Competition::convert_datetime_for_view(Competition::all());
        $now = date("Y-m-d", strtotime(Carbon::now()));

        foreach ($competitions as $key => $competition) {
            $competitions[$key]->types = CompetitionType::get_types($competition->id);
            $competitions[$key]->leagues = CompetitionLeague::get_league_names($competition->id);

            foreach ($competitions[$key]->types as $type) {
                if ($type->id > 2) {
                    $competitions[$key]->second_person = true;
                }
            }
        }

        return view('competitions/index', [
            'competitions' => $competitions,
            'now' => $now
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Make sure required fields are filled
        request()->validate([
            "title" => "required",
            "location" => "required",
            "date" => "required",
            "time" => "required",
            "registration_starts" => "required",
            "registration_ends" => "required",
            "image" => "required",
            "instructions" => "required",
            "doubles" => "required_without:singles",
            "singles" => "required_without:doubles",
            "types" => "required_with:doubles,singles",
            "leagues" => "required"
        ]);

        $datetime = $request->date . " " . $request->time;

        // Save uploaded files (storage/app/*)
        $request->image->storeAs('public/competition_images', $request->image->getClientOriginalName());
        $request->instructions->storeAs('public/competition_instructions', $request->instructions->getClientOriginalName());


        // Save new competition to database
        $competition = new Competition();

        $competition->title = $request->get("title");
        $competition->location = $request->get("location");
        $competition->datetime = Carbon::parse($datetime);
        $competition->registration_starts = Carbon::parse($request->get("registration_starts"));
        $competition->registration_ends = Carbon::parse($request->get("registration_ends"));
        $competition->image = $request->image->getClientOriginalName();
        $competition->instructions = $request->instructions->getClientOriginalName();

        $competition->save();


        // Save competition types to database
        $competition_id = $competition->id;
        foreach ($request->get("types") as $value) {
            $type = new CompetitionType();

            $type->competition_id = $competition_id;
            $type->type_id = $value;

            $type->save();
        }

        // Save competition leagues to database
        foreach ($request->get("leagues") as $value) {
            $league = new CompetitionLeague();

            $league->competition_id = $competition_id;
            $league->league_id = $value;

            $league->save();
        }

        // Redirect to homepage
        return back()->with('stored', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Competition $competition
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Competition $competition)
    {
        $competition_id = $request->competition->id;
        $types = CompetitionType::add_short_names(CompetitionType::get_types($competition_id));
        $registration_starts = strtotime($competition->registration_starts);
        $registration_ends = strtotime($competition->registration_ends);
        $now = strtotime(Carbon::now());
        $unconfirmed_contestants = RegisteredContestant::get_unconfirmed_by_competition_id($competition_id);
        $contestants = RegisteredContestant::get_by_competition_id($competition_id);
        $subgroups = CompetitionType::add_short_names(Subgroup::get($competition_id));
        $second_person = false;

        // Find if competition type is 1 or 2 people
        foreach ($types as $type) {
            if ($type->id > 2) {
                $second_person = true;
            }
        }

        return view('competitions/show', [
            'competition' => $competition,
            'datetime' => strtotime($competition->datetime),
            'leagues' => CompetitionLeague::get_league_names($competition_id),
            'types' => $types,
            'second_person' => $second_person,
            'registration_starts' => $registration_starts,
            'registration_ends' => $registration_ends,
            'now' => $now,
            'unconfirmed_contestants' => $unconfirmed_contestants,
            'contestants' => $contestants,
            'subgroups' => $subgroups
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Competition $competition
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function edit(Competition $competition)
    {
        // Convert all dates into a format that can be used in html
        $datetime = new Carbon($competition->datetime);
        $competition->date = $datetime->format("d.m.Y");
        $competition->time = $datetime->format("H:i");

        $registration_starts = new Carbon($competition->registration_starts);
        $competition->registration_starts = $registration_starts->format("d.m.Y");

        $registration_ends = new Carbon($competition->registration_ends);
        $competition->registration_ends = $registration_ends->format("d.m.Y");

        foreach (CompetitionLeague::get_by_competition_id($competition->id) as $league) {
            $leagues[] = $league->league_id;
        }

        foreach (CompetitionType::get_by_competition_id($competition->id) as $type) {
            $types[] = $type->type_id;
        }

        return view('competitions/edit', [
            'competition' => $competition,
            'leagues' => $leagues,
            'types' => $types
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Competition $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition)
    {
        // Make sure required fields are filled
        request()->validate([
            "title" => "required",
            "location" => "required",
            "datetime" => "required",
            "registration_starts" => "required",
            "registration_ends" => "required",
            "doubles" => "required_without:singles",
            "singles" => "required_without:doubles",
            "types" => "required_with:doubles,singles",
            "leagues" => "required"
        ]);

        $image = $request->image;
        $instructions = $request->instructions;

        // If the image file was updated
        if (!empty($image)) {

            // Save uploaded image at storage/app/public/competition_images
            $image->storeAs('competition_images', $image->getClientOriginalName());

            // Set new name for image in database
            $competition->image = $image->getClientOriginalName();
        }

        // If the instructions file was updated
        if (!empty($instructions)) {

            // Save uploaded image at storage/app/public/competition_instructions
            $instructions->storeAs('competition_instructions', $instructions->getClientOriginalName());

            // Set new name for instructions in database
            $competition->instructions = $instructions->getClientOriginalName();
        }

        // Update competition in database
        $competition->title = $request->get("title");
        $competition->location = $request->get("location");
        $competition->datetime = Carbon::parse($request->get("datetime"));
        $competition->registration_starts = Carbon::parse($request->get("registration_starts"));
        $competition->registration_ends = Carbon::parse($request->get("registration_ends"));

        $competition->update();


        // Update competition types in database
        CompetitionType::update_types($request, $competition->id);

        // Update competition leagues in database
        CompetitionLeague::update_leagues($request, $competition->id);


        // Redirect to competitions page
        return redirect("/competitions")->with('updated', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Competition $competition
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Competition $competition)
    {
        // Delete competition
        $competition->delete();

        return back()->with('deleted', true);
    }
}
