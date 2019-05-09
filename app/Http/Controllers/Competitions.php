<?php

namespace App\Http\Controllers;

use App\Competition;
use App\CompetitionType;
use App\RegisteredContestant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $competitions = Competition::convertDatetimeForView(Competition::all());

        return view('competitions/index', [
            'competitions' => $competitions
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
            "datetime" => "required",
            "registration_starts" => "required",
            "registration_ends" => "required",
            "image" => "required",
            "instructions" => "required",
            "doubles" => "required_without:singles",
            "singles" => "required_without:doubles",
            "types" => "required_with:doubles,singles"
        ]);

        // Save uploaded files (storage/app/*)
        $request->image->storeAs('public/competition_images', $request->image->getClientOriginalName());
        $request->instructions->storeAs('public/competition_instructions', $request->instructions->getClientOriginalName());


        // Save new competition to database
        $competition = new Competition();

        $competition->title = $request->get("title");
        $competition->location = $request->get("location");
        $competition->datetime = Carbon::parse($request->get("datetime"));
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

        // Redirect to homepage
        return redirect("/");
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
        $types = Competition::getTypes($competition_id);
        $registration_starts = strtotime($competition->registration_starts);
        $registration_ends = strtotime($competition->registration_ends);
        $now = strtotime(Carbon::now());
        $contestants = RegisteredContestant::get_unconfirmed_by_competition_id($competition_id);

        // Find if competition type is 1 or 2 people
        $second_person = false;

        foreach ($types as $type) {
            if ($type->id > 2) {
                $second_person = true;
            }
        }


        return view('competitions/show', [
            'competition' => $competition,
            'datetime' => strtotime($competition->datetime),
            'leagues' => Competition::getLeagues($competition_id),
            'types' => $types,
            'second_person' => $second_person,
            'registration_starts' => $registration_starts,
            'registration_ends' => $registration_ends,
            'now' => $now,
            'contestants' => $contestants
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
        $competition->datetime = $datetime->format("d/m/Y");

        $registration_starts = new Carbon($competition->registration_starts);
        $competition->registration_starts = $registration_starts->format("d/m/Y");

        $registration_ends = new Carbon($competition->registration_ends);
        $competition->registration_ends = $registration_ends->format("d/m/Y");


        return view('competitions/edit', [
            'competition' => $competition
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
            "types" => "required_with:doubles,singles"
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


        // --------- Save competition types to database -----------
        $competition_types_to_delete = [];
        $competition_types_to_insert = [];
        $previous_competition_options = [];
        $selected_competition_options = $request->get("types");
        $competition_types = CompetitionType::get_by_competition_id($competition->id);

        foreach ($competition_types as $competition_type) {
            $previous_competition_options[] = $competition_type->type_id;
        }

        // Find which types to delete
        $competition_types_to_delete = array_merge(
            $competition_types_to_delete,
            array_diff($previous_competition_options, $selected_competition_options));

        // Find which types to insert
        $competition_types_to_insert = array_merge(
            $competition_types_to_insert,
            array_diff($selected_competition_options, $previous_competition_options));

        // Delete unselected types
        foreach ($competition_types_to_delete as $type_id) {
            DB::table('competition_types')
                ->where('competition_id', '=', $competition->id)
                ->where('type_id', '=', $type_id)
                ->delete();
        }

        // Insert selected types
        foreach ($competition_types_to_insert as $type_id) {
            $type = new CompetitionType();

            $type->competition_id = $competition->id;
            $type->type_id = $type_id;

            $type->save();
        }

        // Redirect to competitions page
        return redirect("/competitions");
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


        // Delete all competition_types
        DB::table('competition_types')->where('competition_id', '=', $competition->id)->delete();

        // Delete competition
        $competition->delete();

        return redirect('/competitions');
    }
}
