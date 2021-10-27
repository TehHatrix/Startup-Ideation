<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FreeCanvas as Canvas;
use App\Models\Project;

class FreeCanvasController extends Controller
{
    public function index($project) {
        $project = Project::findOrFail($project);
        $canvases = $project->canvases()->get();
        return response([
            'FreeCanvas' => $canvases
        ], 200);
    }

    public function store(Request $request, $project) {
       
        $data = $request->validate([
            'name' => 'required|string'
        ]);

        // $canvas = Canvas::create([
        //     'name' => $data['name'],
        //     'project_id' => $project
        // ]);
        $project = Project::findOrFail($project);
        $canvas = $project->canvases()->create([
            'name' => $data['name']
        ]);

        return response(['FreeCanvas' => $canvas], 200);
    }

    public function show($project, $id) {
        $canvas = Canvas::findOrFail($id)->where('project_id', $project);
        return response(['FreeCanvas' => $canvas], 200);
    }

    public function update(Request $request, $project, $id) {
        $data = $request->validate(['name' => 'required|string']);
        $canvas = Canvas::findOrFail($id)->update([
            'name' => $data['name']
        ]);

        return response(['FreeCanvas' => $canvas], 200);
    }

    public function destroy($project, $id) {
        $canvas = Canvas::find($id)->delete();
        return 'deleted';
    }
}
