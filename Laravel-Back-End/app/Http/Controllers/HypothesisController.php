<?php

namespace App\Http\Controllers;

use App\Models\CustomerProblem;
use App\Models\CustomerSegment;
use App\Models\Hypotheses;
use App\Models\Interview;
use App\Models\Problem;
use ArrayObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class HypothesisController extends Controller
{

    public function getproblemswithcustSeg()
    {
        $problemswithcustSeg = DB::table('problems')->join('customer_segments', 'problems.customer_segment_id', '=', 'customer_segments.id')->select('problems.id', 'problems.topic as problemsTopic', 'customer_segments.topic as customerSegment')->get();
        return $problemswithcustSeg;
    }

    public function gethypothesisdata()
    {
        $hypothesis = DB::table('hypotheses')->get();
        return $hypothesis;
    }

    public function getproblemHypothesis()
    {
        $hypothesisProblem = DB::table('hypotheses')->join('problems', 'problems.id', '=', 'hypotheses.problem_id')->select('problems.id','hypotheses.hypothesis_ID','hypotheses.pain_level_severity', 'hypotheses.pain_level_freq', 'hypotheses.feedback_cycle')->get();
        return $hypothesisProblem;
    }

    public function getinterviewIDbyHypothesis($hypothesisID)
    {
        $interviewID = DB::table('interview')->where('interview.hypothesis_ID','=',$hypothesisID)->value('interview.interview_ID');
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
            'status' => true
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    public function deleteHypothesis($hypothesisID){
        $interviewID = DB::table('interview')->where('hypothesis_ID','=',$hypothesisID)->value('interview_ID');
        $customerInterviewList = DB::table('customer')->where('interview_ID','=',$interviewID)->pluck('cust_ID');
        foreach ($customerInterviewList as $customerID){
            DB::table('customer')->where('cust_ID','=',$customerID)->delete();
        }
        DB::table('interview')->where('hypothesis_ID','=',$hypothesisID)->delete();
        DB::table('hypotheses')->where('hypothesis_ID','=',$hypothesisID)->delete();
        return response()->json(['success' => true, 'message' => 'successfully deleted']);
        

    }
}
