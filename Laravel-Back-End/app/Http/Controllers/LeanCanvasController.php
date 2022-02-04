<?php

namespace App\Http\Controllers;

use App\Events\LeanCanvasUpdated;
use App\Models\Channel;
use App\Models\CostStructure;
use App\Models\CustomerSegment;
use App\Models\KeyMetric;
use App\Models\LeanCanvas;
use App\Models\Problem;
use App\Models\ProblemStatus;
use App\Models\Project;
use App\Models\Revenue;
use App\Models\Solution;
use App\Models\UnfairAdvantage;
use App\Models\UniqueValueProposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeanCanvasController extends Controller
{
    public function index($id) {
        // $customerSegment = LeanCanvas::with('customerSegment')->get();
        $canvas = LeanCanvas::where('project_id', $id)->first();
        $customerSegment = $canvas->customerSegment()->get();
        $problem = $canvas->problem()->get();
        $revenue = $canvas->revenue()->get();
        $solution = $canvas->solution()->get();
        $uva = $canvas->uniqueValueProposition()->get();
        $channel = $canvas->channel()->get();
        $keyMetric = $canvas->keyMetric()->get();
        $cost = $canvas->costStructure()->get();
        $unfairAdvantage = $canvas->unfairAdvantage()->get();


        return response()->json([
            'content' => [
                $customerSegment,
                $problem,
                $revenue,
                $solution,
                $uva,
                $channel,
                $keyMetric,
                $cost,
                $unfairAdvantage
            ],
            'success' => true
        ]);
        
    }

    public function addContent(Request $request, $projectId) {
            $validator = Validator::make($request->all(), [
            'topic' => 'required|string',
            'publisher_id' => 'integer|required',
            'contentType' => 'integer|required',
            'customer_segment_id' => 'integer|nullable'
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $data = $validator->validated();
        $project = Project::find($projectId);
        $canvas = $project->leanCanvases()->get();

        // * content type 1 is customer segment and in array position 0
        if($data['contentType'] === 1) {
            $content = $this->initializeContent($data['contentType']);

            $content->topic = $data['topic'];
            $content->publisher_id = $data['publisher_id'];
            $content->canvas()->associate($canvas[0]->id)->save();

        } else if($data['contentType'] === 2 || $data['contentType'] === 4) {
            // * for mandatory depend on cust segment
            $content = $this->initializeContent($data['contentType']);

            $content->topic = $data['topic'];
            $content->publisher_id = $data['publisher_id'];
            $content->canvas()->associate($canvas[0]->id);
            $content->customerSegment()->associate($data['customer_segment_id'])->save();

            if($data['contentType'] === 2) {
                $problemStatus = new ProblemStatus();
                $problemStatus->validated = false;
                $problemStatus->problem()->associate($content->id);
                $problemStatus->canvas()->associate($content->canvas_id);
                $problemStatus->save();
            }

        } else if ($data['contentType'] === 5) {
            // * for optional depend on cust Segment
            $content = $this->initializeContent($data['contentType']);

            $content->topic = $data['topic'];
            $content->publisher_id = $data['publisher_id'];
            $content->customer_segment_id = $data['customer_segment_id'];
            $content->canvas()->associate($canvas[0]->id)->save();

        } else {
            // * for everything else which does not depend on cust segment
            
            $content = $this->initializeContent($data['contentType']);

            $content->topic = $data['topic'];
            $content->publisher_id = $data['publisher_id'];
            $content->canvas()->associate($canvas[0]->id)->save();
        }

        broadcast(new LeanCanvasUpdated($projectId, $data['contentType']));

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


    public function deleteContent($contentId, $type) {

        $content = null;

        if($type == 1) {
            $content = CustomerSegment::find($contentId);
        } else if ($type == 2) {
            $content = Problem::find($contentId);
        } else if ($type == 3) {
            $content = Revenue::find($contentId);
        } else if ($type == 4) {
            $content = Solution::find($contentId);
        } else if ($type == 5) {
            $content = UniqueValueProposition::find($contentId);
        } else if ($type == 6) {
            $content = Channel::find($contentId);
        } else if ($type == 7) {
            $content = KeyMetric::find($contentId);
        } else if ($type == 8) {
            $content = CostStructure::find($contentId);
        } else if ($type == 9) {
            $content = UnfairAdvantage::find($contentId);
        }

        if($content == null) {
            return response()->json([
                'success' => false
            ]);
        }

        $content->delete();
        $uva = UniqueValueProposition::where('customer_segment_id', $contentId)->delete();
    
        broadcast(new LeanCanvasUpdated($content->canvas_id, $type));

        return response()->json([
            'success' => true
        ]);
    }

    public function updateContent(Request $request, $contentId, $type) {

        $validator = Validator::make($request->all(), [
            'topic' => 'required',
            'customer_segment_id' => 'integer|nullable'
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false
            ]);
        }

        $data = $validator->validated();

        $content = null;
        if($type == 1) {
            $content = CustomerSegment::find($contentId);
        } else if ($type == 2) {
            $content = Problem::find($contentId);
        } else if ($type == 3) {
            $content = Revenue::find($contentId);
        } else if ($type == 4) {
            $content = Solution::find($contentId);
        } else if ($type == 5) {
            $content = UniqueValueProposition::find($contentId);
        } else if ($type == 6) {
            $content = Channel::find($contentId);
        } else if ($type == 7) {
            $content = KeyMetric::find($contentId);
        } else if ($type == 8) {
            $content = CostStructure::find($contentId);
        } else if ($type == 9) {
            $content = UnfairAdvantage::find($contentId);
        }

        $content->topic = $data['topic'];
        if($type == 2 || $type == 4 || $type == 5) {
            $content->customer_segment_id = $data['customer_segment_id'];
        }
        $content->save();
        // pusher
        broadcast(new LeanCanvasUpdated($content->canvas_id, $type));
        return response()->json([
            'success' => true
        ]);
    }

    public function getSegment($canvasId, $type) {

        if($type == 1) {
            $content = CustomerSegment::where('canvas_id', $canvasId)->get();            

        } else if ($type == 2) {
            $content = Problem::where('canvas_id', $canvasId)->get();            
        } else if ($type == 3) {
            $content = Revenue::where('canvas_id', $canvasId)->get();            

        } else if ($type == 4) {
            $content = Solution::where('canvas_id', $canvasId)->get();            

        } else if ($type == 5) {
            $content = UniqueValueProposition::where('canvas_id', $canvasId)->get();            

        } else if ($type == 6) {
            $content = Channel::where('canvas_id', $canvasId)->get();            

        } else if ($type == 7) {
            $content = KeyMetric::where('canvas_id', $canvasId)->get();            

        } else if ($type == 8) {
            $content = CostStructure::where('canvas_id', $canvasId)->get();            

        } else if ($type == 9) {
            $content = UnfairAdvantage::where('canvas_id', $canvasId)->get();            

        } else {
            return response()->json([
                'success' => false,
                'errors' => 'Type not Exist'
            ]);
        }

        return response()->json([
            'success' => true,
            'errors' => null,
            'content' => $content
        ]);
    }

    public function getAllSegment($canvasId) {

        $cs = CustomerSegment::where('canvas_id', $canvasId)->get();            
        $prob = Problem::where('canvas_id', $canvasId)->get();            
        $rev = Revenue::where('canvas_id', $canvasId)->get();            
        $solution = Solution::where('canvas_id', $canvasId)->get();            
        $uva = UniqueValueProposition::where('canvas_id', $canvasId)->get();            
        $channel = Channel::where('canvas_id', $canvasId)->get();            
        $km = KeyMetric::where('canvas_id', $canvasId)->get();            
        $cost = CostStructure::where('canvas_id', $canvasId)->get();            
        $ua = UnfairAdvantage::where('canvas_id', $canvasId)->get();          

        return response()->json([
            'success' => true,
            'customerSegment' => $cs,
            'problem' => $prob,
            'revenue' => $rev,
            'solution' => $solution,
            'uniqueValueProposition' => $uva,
            'channel' => $channel,
            'keyMetric' => $km,
            'costStructure' => $cost,
            'unfairAdvantage' => $ua

        ]);
    }

    public function getStatusValidated($canvasId) {

        $problemArr = ProblemStatus::where('lean_canvas_id', $canvasId)->get();
        return response()->json([
            'success' => true,
            'problemStatusArray' => $problemArr
        ]); 
    }
    
}