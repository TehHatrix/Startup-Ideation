<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\LeanCanvas;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeanCanvasController extends Controller
{
    public function index() {
        
    }

    public function addContent(Request $request, $projectId) {
        $validator = Validator::make($request->all(), [
            'topic' => 'required|string',
            'description' => 'string|nullable',
            'publisher_id' => 'integer|required',
            'contentType' => 'integer|required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $project = Project::find($projectId);
        $canvas = $project->leanCanvases()->get();
        $data = $validator->validated();
        $content = $this->initializeContent($data['contentType']);

        $content->topic = $data['topic'];
        $content->description = $data['description'];
        $content->publisher_id = $data['publisher_id'];
        $content->canvas()->associate($canvas[0]->id)->save();

        return response()->json([
            'content' => $content,
            'success' => true,
            'errors' => null
        ]);
               
    }

    public function initializeContent($type) {
        $contentArr = [
            'CustomerSegment',
            'Problem',
            'Revenue',
            'Solution',
            'UniqueValueProposition',
            'Channel',
            'KeyMetric',
            'CostStructure',
            'UnfairAdvantage'
        ];

        $currentContent = $contentArr[$type-1];
        $namespace = 'App\\Models';
        $content = $namespace . '\\' . $currentContent;

        return new $content;
    }

    
    
    
}
