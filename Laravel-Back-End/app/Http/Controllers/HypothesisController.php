<?php

namespace App\Http\Controllers;

use App\Models\CustomerProblem;
use App\Models\CustomerSegment;
use App\Models\Hypotheses;
use App\Models\Interview;
use App\Models\Problem;
use App\Models\ProblemStatus;
use ArrayObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class HypothesisController extends Controller
{

    public function checkHypothesisValidate($projectID){
        $canvasID = DB::table('lean_canvases')->where('project_id',$projectID)->value('id');
        $problemID = DB::table('problems')->where('canvas_id',$canvasID)->value('id');
        $findTrue = DB::table('hypotheses')->where('problem_id',$problemID)->where('status','=',true)->exists();
        return  response()->json([
            'validateResult' => $findTrue,
            'success' => true,
            'errors' => null
        ]);


    }

    public function getproblemswithcustSeg($projectID)
    {
        $canvasID = DB::table('lean_canvases')->where('project_id',$projectID)->value('id');
        $problemswithcustSeg = DB::table('problems')->where('problems.canvas_id','=',$canvasID)->join('customer_segments', 'problems.customer_segment_id', '=', 'customer_segments.id')->select('problems.id', 'problems.topic as problemsTopic', 'customer_segments.topic as customerSegment')->get();
        return $problemswithcustSeg;
    }

    public function gethypothesisdata()
    {
        $hypothesis = DB::table('hypotheses')->get();
        return $hypothesis;
    }

    public function getproblemHypothesis($projectID)
    {
        $canvasID = DB::table('lean_canvases')->where('project_id',$projectID)->value('id');
        $hypothesisProblem = DB::table('hypotheses')->where('problems.canvas_id','=',$canvasID)->join('problems', 'problems.id', '=', 'hypotheses.problem_id')->select('problems.id', 'hypotheses.hypothesis_ID', 'hypotheses.pain_level_severity', 'hypotheses.pain_level_freq', 'hypotheses.feedback_cycle')->get();
        return $hypothesisProblem;
    }

    public function getinterviewIDbyHypothesis($hypothesisID)
    {
        $interviewID = DB::table('interview')->where('interview.hypothesis_ID', '=', $hypothesisID)->value('interview.interview_ID');
        return $interviewID;
    }




    public function getstatus($customerproblem_id)
    {
        $hypotheseswithcustprob = Hypotheses::where('CustomerProblem_ID', $customerproblem_id)->get();
        if ($hypotheseswithcustprob) {
            foreach ($hypotheseswithcustprob as $record) {
                if ($record->status == true) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getHypothesisID($customerproblem_id)
    {
        $hypotheseswithcustprob = Hypotheses::where('CustomerProblem_ID', $customerproblem_id)->get();
        if ($hypotheseswithcustprob) {
            foreach ($hypotheseswithcustprob as $record) {
                return $record->hypothesis_ID;
            }
        }
    }



    public function getCustomerSegmentsTopic()
    {
        $arrayobj = new ArrayObject(array());
        foreach (CustomerSegment::all() as $custseg) {
            $thetopic = $custseg->topic;
            $arrayobj->append($thetopic);
        }
        return $arrayobj;
    }

    public function getProblemsTopic()
    {
        $arrayobj = new ArrayObject(array());
        foreach (Problem::all() as $prob) {
            $thetopic = $prob->topic;
            $arrayobj->append($thetopic);
        }
        return $arrayobj;
    }


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
        $validator = Validator::make($request->all(), [
            'problems' => 'string|required',
            'pain.frequency' => 'string|required',
            'pain.severity' => 'string|required',
            'feedbackCycle' => 'string|required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        $matchingProblemTopicandID = DB::table('problems')->where('topic', '=', $data['problems'])->value('id');
        $insertHypothesis = DB::table('hypotheses')->insert([
            'problem_id' => $matchingProblemTopicandID,
            'pain_level_severity' => $data['pain']['severity'],
            'pain_level_freq' => $data['pain']['frequency'],
            'feedback_cycle' => $data['feedbackCycle'],
            'status' => false
        ]);
        $id = DB::getPdo()->lastInsertId();
        return  response()->json([
            'hypothesisID' => $id,
            'success' => true,
            'errors' => null
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


    public function setHypothesisTrue($interviewID){
        $hypothesisID = DB::table('interview')->where('interview_ID',$interviewID)->value('hypothesis_ID');
        $validate = DB::table('hypotheses')->where('hypothesis_ID', $hypothesisID)->update(['status' => true]);
        $problemId = DB::table('hypotheses')->where('hypothesis_ID', $hypothesisID)->value('problem_id');
        $problemStatus = DB::table('problem_statuses')->where('problem_id', $problemId)->update(['validated' => true]);

        return  response()->json([
            'validateResult' => $validate,
            'success' => true,
            'errors' => null
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateHypothesis(Request $request, $hypothesisID)
    {
        $validator = Validator::make($request->all(), [
            'feedback_cycle' => 'string|nullable',
            'pain_level_freq' => 'string|nullable',
            'pain_level_severity' => 'string|nullable',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        $update = DB::table('hypotheses')->where('hypothesis_ID', $hypothesisID)->update($data);
        return  response()->json([
            'update' => $update,
            'success' => true,
            'errors' => null
        ]);
    }

    public function updateCustomerProblem(Request $request, $customerproblem_id, $tablenumber, $table)
    {
        $CustomerProblem = CustomerProblem::find($customerproblem_id);
        if ($CustomerProblem && $tablenumber == 1) {
            $customersegment = CustomerSegment::where('topic', $table)->get();
            if ($customersegment) {
                foreach ($customersegment as $record) {
                    $thenewid = $record->cs_ID;
                }
                $CustomerProblem->cs_ID = $thenewid;
                $CustomerProblem->save();
                return $CustomerProblem;
            }
            return "Customer Segment not found";
        } elseif ($CustomerProblem && $tablenumber == 2) {
            $problem = Problem::where('topic', $table)->get();
            if ($problem) {
                foreach ($problem as $record) {
                    $thenewprobid = $record->problem_ID;
                }
                $CustomerProblem->problem_ID = $thenewprobid;
                $CustomerProblem->save();
                return $CustomerProblem;
            }
            return "Problem not found";
        }
        return "Customer Problem not found";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($customerproblem_id)
    // {
    //     $CustomerProblem_item = CustomerProblem::find($customerproblem_id);
    //     if ($CustomerProblem_item) {
    //         $customersegmentcp_id = $CustomerProblem_item->cs_ID;
    //         $problemcp_id = $CustomerProblem_item->problem_ID;
    //         $customer_segment = CustomerSegment::find($customersegmentcp_id);
    //         $problem = Problem::find($problemcp_id);
    //         $Hypotheses = Hypotheses::where('CustomerProblem_ID', $customerproblem_id);
    //         // $Interview = Interview::where('hypothesis_ID',)
    //         if ($Hypotheses) {
    //             $Hypotheses->delete();
    //         }
    //         $CustomerProblem_item->delete();
    //         // $customer_segment-> delete();
    //         // $problem->delete();
    //     }
    //     //
    // }

    public function deleteHypothesis($hypothesisID)
    {
        $interviewID = DB::table('interview')->where('hypothesis_ID', '=', $hypothesisID)->value('interview_ID');
        $customerInterviewList = DB::table('customer')->where('interview_ID', '=', $interviewID)->pluck('cust_ID');
        foreach ($customerInterviewList as $customerID) {
            DB::table('customer')->where('cust_ID', '=', $customerID)->delete();
        }
        DB::table('interview')->where('hypothesis_ID', '=', $hypothesisID)->delete();
        DB::table('hypotheses')->where('hypothesis_ID', '=', $hypothesisID)->delete();
        return response()->json(['success' => true, 'message' => 'successfully deleted']);
    }
}
