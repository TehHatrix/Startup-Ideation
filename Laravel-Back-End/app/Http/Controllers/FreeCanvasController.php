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
        // return response([
        //     'FreeCanvas' => $canvases,
        //     'success' => true
        // ], 200);
        return response()->json([
            'FreeCanvas' => $canvases,
            'success' => true
        ]);
    }

    public function store(Request $request, $project) {
       
        $data = $request->validate([
            'name' => 'required|string'
        ]);

        $project = Project::findOrFail($project);
        $canvas = $project->canvases()->create([
            'name' => $data['name']
        ]);

        $content = $canvas->contents()->create([
            'content' => ''
        ]);

        // return response(['FreeCanvas' => $canvas, 'success' => true], 200);
        return response()->json([
            'FreeCanvas' => $canvas,
            'success' => true
        ]);
    }

    public function show($project, $id) {
        $canvas = Canvas::findOrFail($id);
        // return response(['FreeCanvas' => $canvas], 200);
        return response()->json([
            'FreeCanvas' => $canvas,
            'success' => true
        ]);
    }

    public function update(Request $request, $project, $id) {
        $data = $request->validate(['name' => 'required|string']);
        $canvas = Canvas::findOrFail($id)->update([
            'name' => $data['name']
        ]);

        // return response(['FreeCanvas' => $canvas], 200);
        return response()->json([
            'FreeCanvas' => $canvas,
            'success' => true
        ]);
    }

    public function destroy($project, $id) {
        $canvas = Canvas::find($id)->delete();
        // return 'deleted';
        return response()->json([
            'FreeCanvas' => $canvas,
            'success' => true
        ]);
    }
}
