<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Project;
use App\Models\Milestone;
use Response;
use Illuminate\Support\Facades\Validator;

class MilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'milestone_name' => 'required',
            'release' => 'required',
            'project_id' => 'required'
        ]);

        if ($validator->fails()) {
            return Response::json(['message' => "Error Saving Milestone"], 202, array(), JSON_PRETTY_PRINT);
        }

        $milestone = new Milestone;
        $milestone->milestone_name = $request->get('milestone_name');
        $milestone->release = $this->startOfWeek($request->get('release'));
        $milestone->is_important = ($request->get('is_important') == "true") ? 1 : 0;
        $milestone->project_id = $request->get('project_id');

        $milestone->save();

        return Response::json(['message' => "Save milestone"], 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Response::json([
            'milestones' => Milestone::where('project_id', $id)->with('users')->get(),
            'project' => Project::find($id)
        ], 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * Get milestone detailed
     */
    public function showDetailed($id) 
    {
        $milestone = Milestone::find($id);
        return Response::json([
            'milestone_name' => $milestone->milestone_name,
            'milestone_users' => $milestone->users
        ], 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $milestone = Milestone::find($id);
        $milestone->milestone_name = $request->get('milestone_name');
        $milestone->release = $request->get('release');
        $milestone->is_important = ($request->get('is_important') == "true") ? 1 : 0;
        $milestone->save();

        return Response::json(['message' => "Project Updated!"], 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $milestone = Milestone::find($id);

        $milestone->delete();

        return Response::json(['message' => "Milestone Deleted!"], 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * Format date to make it the first day of the week
     *
     * @param  datetime  $release
     * @return \Carbon\Carbon
     */
    private function startOfWeek($release)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $release)->startOfWeek()->format('Y-m-d');
    }
}
