<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Response;
use App\Http\Requests;
use App\Models\Project;
use App\Models\Milestone;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOld()
    {
        $project_milestones = [];
        
        $projects = Project::get();       

        $releases = Milestone::groupBy('release')->get();
        
        foreach($releases as $release) {
            $project_milestones[$release->release] = array();
            $milestones = Milestone::with('users')->where('release', $release->release)->get();

            // loop the project
            foreach($projects as $project) {

                // adding project id into the array key with empty value
                $project_milestones[$release->release][$project->id] = array();

                // loop the milestone by release
                foreach ($milestones as $milestone) {

                    if ($project->id == $milestone->project_id) {
                        if (empty($project_milestones[$release->release][$project->id])) {
                            $project_milestones[$release->release][$project->id] = $milestone->toArray();
                            // array_push($project_milestones[$release->release][$project->id], $milestone->toArray());
                        }
                    }
                }
            }
        }
        return Response::json([ 'project_milestones' => $project_milestones, 'projects' => $projects], 200, array(), JSON_PRETTY_PRINT);
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
        $project = new Project;
        $project->project_name = $request->get('name');
        $project->save();
        
        return Response::json(['message' => "Project added!"], 200, array(), JSON_PRETTY_PRINT);
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
        $project = Project::find($id);
        $project->project_name = $request->get('project_name');
        $project->save();

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
        $project = Project::find($id);

        $project->delete();

        return Response::json(['message' => "Project Deleted!"], 200, array(), JSON_PRETTY_PRINT);
    }

    public function beta() {
        $this->index();
    }

    public function index() 
    {
        $project_milestones = [];

        $project_milestonesV2 = [];
        
        $projects = Project::get();       

        $milestones = Milestone::with('users')->get();

        foreach ($projects->toArray() as $key => $project) {
            // loop all milestone
            foreach ($milestones->toArray() as $milestone) {

                // check if the release date is not exist on pm array
                if (!array_key_exists($milestone['release'], $project_milestones)) {

                    if ($project['id'] == $milestone['project_id']) {

                        // add release to new key in array is not yet exist
                        $project_milestones[$milestone['release']][$milestone['project_id']] = array($milestone);
                    } else {
                        // add release to new key in array is not yet exist
                        $project_milestones[$milestone['release']][$project['id']] = array();
                    }
                    

                } else {
                    if ($project['id'] == $milestone['project_id']) {
                        // check if project id is a key of pm array with the release key
                        if (!array_key_exists($milestone['project_id'], $project_milestones[$milestone['release']])) {

                            // pass if not exist
                            $project_milestones[$milestone['release']][$milestone['project_id']] = array($milestone);
                        } else {
                            // append if exist
                            array_push($project_milestones[$milestone['release']][$milestone['project_id']], $milestone);
                                
                        }
                    } else {
                        if (!array_key_exists($project['id'], $project_milestones[$milestone['release']])) {
                            array_push($project_milestones[$milestone['release']], array($project['id'] => array()));    
                        }
                        
                    }
                }
            }
        }

        $milestone_release = Milestone::groupBy('release')->get()->toArray();
        
        foreach($projects->toArray() as $project) {
            // add new key which is the project id
            $project_milestonesV2[$project['id']] = $project;

            // get milestone with users by project_id 
            // toarray
            // collection
            $milestones = Milestone::with('users')->where('project_id', $project['id'])->get()->toArray();

            // declare new key `milestones` that is empty
            $project_milestonesV2[$project['id']]['milestones'] = array();

            // loop all milestone_release
            foreach($milestone_release as $mr) {
                array_push($project_milestonesV2[$project['id']]['milestones'], $mr['release']);
                $milestones_by_release = Milestone::with('users')->where('release', $mr['release'])->get();
                // dprint(array($mr['release'] => $milestones_by_release->toArray()));
                foreach($milestones_by_release as $milestone) {
                    $project_milestonesV2[$project['id']]['milestone'][$mr['release']] = $milestone;
                }
            }
        }

        $all_milestone_by_release = [];
        foreach($milestone_release as $release) {
            $milestones = Milestone::with('users')->where('release', $release['release'])->get()->toArray();
            $all_milestone_by_release[$release['release']] = array();
            foreach($milestones as $milestone) {
                $all_milestone_by_release[$release['release']] = $milestone;
            }
        }

        return Response::json([
            'v2' => [
                // 'all_milestone_by_release' => $all_milestone_by_release,
                'all_projects' => $project_milestonesV2,
                // 'release' => $milestone_release,
                // 'projects' => Project::all(),
            ],
            'v1' => [
                'project_milestones' => $project_milestones, 
                // 'projects' => $projects
            ]
        ], 200, array(), JSON_PRETTY_PRINT);
    }

    private function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }
}
