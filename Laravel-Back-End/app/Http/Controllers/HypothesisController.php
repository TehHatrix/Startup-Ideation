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

class HypothesisController extends Controller
{

    public function getproblemswithcustSeg()
    {
        $problemswithcustSeg = DB::table('problems')->join('customer_segments', 'problems.customer_segment_id', '=', 'customer_segments.id')->select('problems.id','problems.topic as problemsTopic', 'customer_segments.topic as customerSegment')->get();
        return $problemswithcustSeg;
    }

    public function gethypothesisdata()
    {
        $hypothesis = DB::table('hypotheses')->get();
        return $hypothesis;
    }

    public function getproblemHypothesis()
    {
        $hypothesisProblem = DB::table('hypotheses')->join('problems','problems.id','=','hypotheses.problem_id')->select('problems.id','hypotheses.pain_level_severity','hypotheses.pain_level_freq','hypotheses.feedback_cycle')->get();
        return $hypothesisProblem;
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
        $matchingProblemTopicandID = DB::table('problems')->where('topic','=',$request->problems)->value('id');
        $insertHypothesis = DB::table('hypotheses')->insert([
            'problem_id'=> $matchingProblemTopicandID,
            'pain_level_severity' => $request->pain['severity'],
            'pain_level_freq' => $request->pain['frequency'],
            'feedback_cycle' => $request->feedbackCycle,
            'status' => true
        ]);
        if($insertHypothesis){
            return "Insert Successful";
        } else {
            return "Error inserting to table";
        }

        // $newhypothesis = new Hypotheses;
        // $newhypothesis->problem_id = $request->cus
        // $newhypothesis = new Hypotheses;
        // $newhypothesis->CustomerProblem_ID = $request->hypothesis['problem_id'];
        // $newhypothesis->pain_level_severity = $request->hypothesis['pain_level_severity'];
        // $newhypothesis->pain_level_freq = $request->hypothesis['pain_level_freq'];
        // $newhypothesis->feedback_cycle = $request->hypothesis['feedback_cycle'];
        // $newhypothesis->status = $request->hypothesis['status'];
        // $newhypothesis->save();

        // return $newhypothesis;
        //
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
    public function destroy($customerproblem_id)
    {
        $CustomerProblem_item = CustomerProblem::find($customerproblem_id);
        if ($CustomerProblem_item) {
            $customersegmentcp_id = $CustomerProblem_item->cs_ID;
            $problemcp_id = $CustomerProblem_item->problem_ID;
            $customer_segment = CustomerSegment::find($customersegmentcp_id);
            $problem = Problem::find($problemcp_id);
            $Hypotheses = Hypotheses::where('CustomerProblem_ID', $customerproblem_id);
            // $Interview = Interview::where('hypothesis_ID',)
            if ($Hypotheses) {
                $Hypotheses->delete();
            }
            $CustomerProblem_item->delete();
            // $customer_segment-> delete();
            // $problem->delete();
        }
        //
    }
}
