<?php

namespace App\Http\Controllers;


use App\Models\Project;
use App\Models\Milestone;

class AngularController extends Controller
{
    public function serveApp()
    {
        return view('index');
    }

    public function home() 
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
                $all_milestone_by_release[$release['release']] = [$milestone['id'] => $milestone];
            }
        }
        // dprint($project_milestonesV2);
    	return view('home', ['project_milestones' => $project_milestones, 'all_projects' => $project_milestonesV2]);
    }

    public function unsupported()
    {
        return view('unsupported_browser');
    }
}
