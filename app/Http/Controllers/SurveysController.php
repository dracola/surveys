<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Survey, User};

class SurveysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Survey::with('users')->orderBy('id', 'desc')->get();
        // For vue component
        $users = User::get(['id', 'name'])->toJson();

        return view('surveys.index', [
            'surveys' => $surveys,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $survey = new Survey($request->all());
        $survey->save();

        // Save the users to survey
        $survey->users()->attach($request->users);

        // return redirect()->route('surveys.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        // Lazy-eager loading
        $survey->load('users');
        // For vue component
        $users = User::get(['id', 'name'])->toJson();

        return view('surveys.edit', [
            'survey' => $survey,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        $survey->fill($request->all());
        $survey->save();

        // Update the relation
        $survey->users()->toggle($request->users);

        // return redirect()->route('surveys.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        $survey->delete();

        return redirect()->route('surveys.index');
    }
}
