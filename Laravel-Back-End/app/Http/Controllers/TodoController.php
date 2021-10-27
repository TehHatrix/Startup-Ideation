<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectId)
    {
        // $task = Project::with('todos')->where('id', $projectId)->get();
        $project = Project::findOrFail($projectId);
        $task = $project->todos()->get();
        return response()->json([
            'todo' => $task,
            'success' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $projectId)
    {
        $data = $request->validate([
            'task' => 'required|string',
            'assigned_to' => 'nullable|integer',
            'due_date' => 'nullable|date'
        ]);

        $task = Todo::create([
            'task' => $data['task'],
            'assigned_to' => $data['assigned_to'],
            'due_date' => $data['due_date'],
            'completed' => false,
            'project_id' => $projectId
        ]);

        // $task->project()->attach($projectId);

        return response([
            'task' => $task
        ], 200);

        return new TodoResource($this->successResponse($task));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($project, $todo)
    {
        // $task = Todo::with('project')->where('id', $todo)->get();
        $task = Todo::findOrFail($todo)->where('project_id', $project)->get();
        return $task;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project, $id)
    {
        $data = $request->validate([
            'task' => 'required|string',
            'assigned_to' => 'nullable|integer',
            'due_date' => 'nullable|date',
            'completed' => 'boolean'
        ]);

        $task = Todo::findOrFail($id)->where('project_id', $project)->update([
            'task' => $data['task'],
            'assigned_to' => $data['assigned_to'],
            'due_date' => $data['due_date'],
            'completed' => $data['completed']
        ]);

        return response($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project, $id)
    {
        $task = Todo::find($id)->where('project_id', $project)->delete();
        return response('success', 200);
    }
}
