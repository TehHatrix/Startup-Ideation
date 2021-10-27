<?php
namespace App\Http\Controllers;

use App\Models\CustomerProblem;
use App\Models\CustomerSegment;
use App\Models\Hypotheses;
use App\Models\Interview;
use App\Models\Problem;
use ArrayObject;
use Illuminate\Http\Request;

class HypothesisController extends Controller
{

     public function getHypothesisData(){
         //joining the table
         $customerproblemswithdata = CustomerProblem::with('customersegments','problems','hypotheses')->get();
         $arrayobj = new ArrayObject(array());
         //Access each records
         foreach ($customerproblemswithdata as $record){
            $customerProblemID = $record->CustomerProblem_ID;
            $topic_custseg = $record->customersegments->topic;
            $topic_problem = $record->problems->topic;
            if($record->hypotheses != null){
                $status = $record->hypotheses->status;
                $arrayofobjects = array($customerProblemID,$topic_custseg,$topic_problem,$status);
            }
            else{
                $status = false;
                $arrayofobjects = array($customerProblemID,$topic_custseg,$topic_problem,$status);
            }
            $arrayobj->append($arrayofobjects);
            // $arrayobj->append($customerProblemID);
            // $arrayobj->append($topic_custseg);
            // $arrayobj->append($topic_problem);
         }
         return $arrayobj;
        //  return $customersegments;
     }

     public function getstatus($customerproblem_id){
         $hypotheseswithcustprob = Hypotheses::where('CustomerProblem_ID',$customerproblem_id)->get();
         if ($hypotheseswithcustprob){
             foreach ($hypotheseswithcustprob as $record){
                 if ($record->status == true){
                     return true;
                 }
             }
         }
         return false;

     }

     public function getHypothesisID($customerproblem_id){
        $hypotheseswithcustprob = Hypotheses::where('CustomerProblem_ID',$customerproblem_id)->get();
        if ($hypotheseswithcustprob){
            foreach ($hypotheseswithcustprob as $record){
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
        $newhypothesis = new Hypotheses;
        $newhypothesis->CustomerProblem_ID = $request->hypothesis['customerproblem_id'];
        $newhypothesis->pain_level_severity = $request->hypothesis['pain_level_severity'];
        $newhypothesis->pain_level_freq = $request->hypothesis['pain_level_freq'];
        $newhypothesis->feedback_cycle = $request->hypothesis['feedback_cycle'];
        $newhypothesis->status = $request->hypothesis['status'];
        $newhypothesis->save();

        // $newcustomerSegment = new CustomerSegment;
        // $newcustomerSegment->topic = $request->customersegment['topic'];
        // $newcustomerSegment->description = $request->customersegment['description'];
        // $newcustomerSegment->publisher = $request->customersegment['publisher'];
        // $newcustomerSegment->save();

        return $newhypothesis;
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
    public function updateCustomerProblem(Request $request, $customerproblem_id,$tablenumber,$table)
    {
        $CustomerProblem = CustomerProblem::find($customerproblem_id);
        if ($CustomerProblem && $tablenumber == 1){
            $customersegment = CustomerSegment::where('topic',$table)->get();
            if($customersegment){
                foreach ($customersegment as $record){
                    $thenewid = $record->cs_ID;
                }
                $CustomerProblem->cs_ID = $thenewid;
                $CustomerProblem->save();
                return $CustomerProblem;
            }
            return "Customer Segment not found";

        }
        elseif($CustomerProblem && $tablenumber == 2){
            $problem = Problem::where('topic',$table)->get();
            if($problem){
                foreach ($problem as $record){
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
        if($CustomerProblem_item){
            $customersegmentcp_id = $CustomerProblem_item->cs_ID;
            $problemcp_id = $CustomerProblem_item->problem_ID;
            $customer_segment = CustomerSegment::find($customersegmentcp_id);
            $problem = Problem::find($problemcp_id);
            $Hypotheses = Hypotheses::where('CustomerProblem_ID',$customerproblem_id);
            // $Interview = Interview::where('hypothesis_ID',)
            if($Hypotheses){
                $Hypotheses->delete();
            }
            $CustomerProblem_item->delete();
            // $customer_segment-> delete();
            // $problem->delete();
        }
        //
    }
}
