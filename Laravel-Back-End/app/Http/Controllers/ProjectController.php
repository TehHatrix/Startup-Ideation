<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = User::find(Auth::id())->projects;

        // $projects = User::find(Auth::id())->projects()->get();

        return response(['projects' => $projects ], 200);
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->validate([
        //     'project_name' => 'required',
        //     'project_description' => 'required'
        // ]);

        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'project_description' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors, 'success' => false]);
        }

        $data = $validator->validated();

        $project = Project::create([
            'project_name' => $data['project_name'],
            'project_description' => $data['project_description']
        ]);

        $project->users()->attach(Auth::id());

        // $user = Auth::user();
        // $project = $user->projects()->create([
        //     'project_name' => $data['project_name'],
        //     'project_description' => $data['project_description']
        // ]);

        return response()->json([
            'errors' => [],
            'message' => 'successful',
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $collaborator = $project->users()->get(array('id', 'name'))->toArray();
        
        // $project = User::find(Auth::id())->projects()->where('id', $id)->get();
        
        $tempId = array();
        foreach ($collaborator as $user) {
            array_push($tempId, $user['id']);
        }
        if(!in_array(Auth::id(), $tempId)) {
            // return response(['message' => 'you are not the collaborator for this project'], 401);
            return response()->json(['message' => 'you are not the collaborator for this project', 'success' => false], 401);
        }    
        
        // return response([
        //     'project' => $project,
        //     'collaborator' => $collaborator], 200);

        return response()->json([
            'project' => array('id' => $project['id'],'project_name' => $project['project_name'],'project_description' => $project['project_description'], 'collaborator' => $collaborator),
            'success' => true,
            'message' => 'successfull'
        ]);
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
        $data = $request->validate([
            'project_name' => 'required',
            'project_description' => 'required',
            'collaborator' => 'array',
            'collaborator.*' => 'integer',
            'remove_collaborator' => 'array',
            'remove_collaborator.*' => 'integer'
        ]);

        // $project = Project::with('users')->where('id', $id)->get();
        // return $project;

        $project = Project::find($id);
        $collaborator = $project->users()->get(array('id', 'name'))->toArray();
        
        $tempId = array();
        foreach ($collaborator as $user) {
            array_push($tempId, $user['id']);
        }
        if(!in_array(Auth::id(), $tempId)) {
            return response(['message' => 'you are not the collaborator for this project'], 401);
        } 

        $project->project_name = $data['project_name'];
        $project->project_description = $data['project_description'];
        $project->save();

        if(!empty($data['collaborator'])) {
            foreach ($data['collaborator'] as $id) {
                $project->users()->attach($id);
            }
        }
        if(!empty($data['remove_collaborator'])) {
            foreach ($data['remove_collaborator'] as $id) {
                $project->users()->detach($id);
            }
        }
        $collaborator = $project->users()->get(array('id', 'name'))->toArray();

        return response([
            'project' => $project,
            'collaborator' => $collaborator
        ], 200);
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
        $collaborator = $project->users()->get(array('id', 'name'))->toArray();
        
        $tempId = array();
        foreach ($collaborator as $user) {
            array_push($tempId, $user['id']);
        }
        if(!in_array(Auth::id(), $tempId)) {
            return response(['message' => 'you are not the collaborator for this project'], 401);
        } 

        $project->users()->detach();
        $project->delete();

        return response()->json(['success' => true]);
        
    }
}


/*
    crud project 
    check project belogn to user 
    ad collab

*/