<?php

namespace App\Http\Controllers;

use App\Events\FreeCanvasUpdated;
use Illuminate\Http\Request;
use App\Models\FreeCanvas as Canvas;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class FreeCanvasController extends Controller
{
    public function index($projectId) {
        $project = Project::findOrFail($projectId);
        $canvases = $project->canvases()->get();

        return response()->json([
            'FreeCanvas' => $canvases,
            'success' => true
        ]);
    }

    public function store(Request $request, $projectId) {
       
        // $data = $request->validate([
        //     'name' => 'required|string'
        // ]);

        // $project = Project::findOrFail($project);
        // $canvas = $project->canvases()->create([
        //     'name' => $data['name']
        // ]);

        // $content = $canvas->contents()->create([
        //     'content' => ''
        // ]);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $data = $validator->validated();

        $project = Project::find($projectId);
        $canvas = $project->canvases()->create([
            'name' => $data['name']
        ]);

        $content = $canvas->contents()->create([
            'content' => ''
        ]); 

        broadcast(new FreeCanvasUpdated($projectId))->toOthers();
        return response()->json([
            'FreeCanvas' => $canvas,
            'success' => true
        ]);
    }

    public function show($projectId, $id) {
        $canvas = Canvas::findOrFail($id);
        // return response(['FreeCanvas' => $canvas], 200);
        return response()->json([
            'FreeCanvas' => $canvas,
            'success' => true
        ]);
    }

    public function update(Request $request, $projectId, $id) {
        $data = $request->validate(['name' => 'required|string']);
        $canvas = Canvas::findOrFail($id)->update([
            'name' => $data['name']
        ]);

        broadcast(new FreeCanvasUpdated($projectId))->toOthers();


        // return response(['FreeCanvas' => $canvas], 200);
        return response()->json([
            'FreeCanvas' => $canvas,
            'success' => true
        ]);
    }

    public function destroy($projectId, $id) {
        $canvas = Canvas::find($id)->delete();
        // return 'deleted';
        broadcast(new FreeCanvasUpdated($projectId))->toOthers();

        return response()->json([
            'FreeCanvas' => $canvas,
            'success' => true
        ]);
    }
}
