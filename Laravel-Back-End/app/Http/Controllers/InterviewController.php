<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = DB::table('interview')->where('interview_ID', '=', $id)->join('hypotheses', 'interview.hypothesis_ID', '=', 'hypotheses.hypothesis_ID')->get();
        $problemID = $data[0]->problem_id;
        $customersegmentwithProb = DB::table('problems')->where('problems.id', '=', $problemID)->join('customer_segments', 'problems.customer_segment_id', '=', 'customer_segments.id')->select('customer_segments.topic as custsegTopic', 'problems.topic as problemsTopic')->get();
        $data[0]->custsegment = $customersegmentwithProb[0]->custsegTopic;
        $data[0]->problems = $customersegmentwithProb[0]->problemsTopic;
        $customerScoreData = DB::table('customer')->where('interview_ID', '=', $id)->pluck('custscore');
        $interviewCounts = DB::table('customer')->where('interview_ID', '=', $id)->count();
        $data[0]->customerScore = $customerScoreData;
        return response()->json([
            'interviewData' => $data,
            'success' => true,
            'errors' => null
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'hypothesisID' => 'integer|required',
            'script' => 'string|nullable',
            'objective' => 'string|required',
            'goal' => 'integer|required',
            'overallScore' => 'between:0,99.99|required',
            'progress' => 'integer|required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        $insertInterview = DB::table('interview')->insert([
            'hypothesis_ID' => $data['hypothesisID'],
            'script' => $data['script'],
            'objective' => $data['objective'],
            'goal' => $data['goal'],
            'overall_score' => $data['overallScore'],
            'progress' => $data['progress'],
        ]);
        $id = DB::getPdo()->lastInsertId();
        if ($insertInterview) {
            return  response()->json([
                'interviewID' => $id,
                'success' => true,
                'errors' => null
            ]);
        } else {
            return  response()->json([
                'success' => false,
            ]);
        }
    }

    public function updateScript(Request $request, $interviewID)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'string|nullable',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        $updateScript = DB::table('interview')
            ->where('interview_ID', $interviewID)
            ->update(['script' => $data['text']]);
        return  response()->json([
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
