<?php

namespace App\Http\Controllers;

use App\Events\CollaboratorAdded;
use App\Models\LeanCanvas;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

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

        return response()->json([
            'success' => true,
            'projects' => $projects
        ], 200);
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
            'project_name' => 'required',
            'project_description' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false]);
        }

        $data = $validator->validated();

        $project = Project::create([
            'project_name' => $data['project_name'],
            'project_description' => $data['project_description'],
            'creator_id' => Auth::id()
        ]);

        $project->users()->attach(Auth::id());

        $leanCanvas = new LeanCanvas;
        $leanCanvas->project()->associate($project->id)->save();
        
        // $user = Auth::user();
        
        // $project = $user->projects()->create([
        //     'project_name' => $data['project_name'],
        //     'project_description' => $data['project_description']
        // ]);

        return response()->json([
            'errors' => null,
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
        $collaborator = $project->users()->get(array('id', 'name', 'username'))->toArray();
        
        // $project = User::find(Auth::id())->projects()->where('id', $id)->get();
        
        $tempId = array();
        foreach ($collaborator as $user) {
            array_push($tempId, $user['id']);
        }
        if(!in_array(Auth::id(), $tempId)) {
            // return response(['message' => 'you are not the collaborator for this project'], 401);
            // return response()->json(['message' => 'you are not the collaborator for this project', 'success' => false, 'errors' => ['you are not authorized']], 401);
            return response()->json([
                'success' => false,
                'errors' => 'No Project found in your project list'
            ]);
        }    
        
        // return response([
        //     'project' => $project,
        //     'collaborator' => $collaborator], 200);

        return response()->json([
            'project' => array(
                'id' => $project['id'],
                'project_name' => $project['project_name'],
                'project_description' => $project['project_description'],
                'creator_id' => $project['creator_id'],
                'collaborator' => $collaborator
            ),
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
        // $data = $request->validate([
        //     'project_name' => 'required',
        //     'project_description' => 'required',
        //     'collaborator' => 'array',
        //     'collaborator.*' => 'integer',
        //     'remove_collaborator' => 'array',
        //     'remove_collaborator.*' => 'integer'
        // ]);

        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'project_description' => 'required',
            'collaborator' => 'array',
            'collaborator.*' => 'integer',
            'remove_collaborator' => 'array', 
            'remove_collaborator.*' => 'integer'
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $data = $validator->validated();

        // $project = Project::with('users')->where('id', $id)->get();
        // return $project;

        $project = Project::find($id);
        $collaborator = $project->users()->get(array('id', 'name'))->toArray();
        
        $tempId = array();
        foreach ($collaborator as $user) {
            array_push($tempId, $user['id']);
        }
        if(!in_array(Auth::id(), $tempId)) {
            return response([
                'success' => false, 
                'errors' => 'you are not a colaborator for this project'
            ]);
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

        // return response([
        //     'project' => $project,
        //     'collaborator' => $collaborator
        // ], 200);
        
        return response()->json([
            'project' => $project,
            'collaborator' => $collaborator,
            'success' => true,
            'errros' => null
        ]);
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
        
        $leanCanvas = LeanCanvas::where('project_id', $id)->delete();
        
        $project->users()->detach();
        $project->delete();

        return response()->json(['success' => true, 'message' => 'successfully deleted']);
        
    }

    public function getUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required'
        ]);


        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'success' => false
            ]);
        }

        $data = $validator->validated();
        
        $user = User::select('username', 'id')->where('username', strtolower($data['username']))->first();
        
        if(!$user) {
            return response()->json([
                'user' => $user,
                'errors' => 'user does not exist',
                'success' => false
            ]);
        }
        return response()->json([
            'user' => $user,
            'success' => true,
            'errors' => null
        ]);

    }

    public function addCollab(Request $request, $projectId) {
        $validator = Validator::make($request->all(), [
            'username' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'success' => false
            ]);
        }

        $data = $validator->validated();
        $user = User::select('username', 'id')->where('username', strtolower($data['username']))->first();
        if(!$user) {
            return response()->json([
                'user' => $user,
                'errors' => 'user does not exist',
                'success' => false
            ]);
        }

        $project = Project::find($projectId);
        $project->users()->attach($user->id);

        broadcast(new CollaboratorAdded($user->id));

        return response()->json([
            'success' => true,
            'errors' => null
        ]);
    }

    public function removeCollab(Request $request, $projectId) {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'success' => false
            ]);
        }

        $data = $validator->validated();
        $project = Project::find($projectId);
        $project->users()->detach($data['id']);

        broadcast(new CollaboratorAdded($data['id']));

        return response()->json([
            'success' => true,
            'errors' => null,

        ]);

    } 
}


/*
    crud project 
    check project belogn to user 
    ad collab

*/