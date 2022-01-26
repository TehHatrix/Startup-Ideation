<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{

    public function checkExistSurveyProject($projectID){
        $searchProjectID = DB::table('survey')->where('projectID','=',$projectID)->exists();
        return $searchProjectID;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectID)
    {
        $surveyData = DB::table('survey')->where('projectID',$projectID)->get();
        return response()->json([
            'success' => true,
            'surveyData' => $surveyData,
        ]);
        //
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
    public function store(Request $request,$projectID)
    {
        $validator = Validator::make($request->all(), [
            'surveyName' => 'string|required',
            'surveyGoal' => 'integer|required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        $initializeJSON = json_encode (json_decode ("[]"));
        $insertSurvey = DB::table('survey')->insert([
            'projectID' => $projectID,
            'survey_name' => $data['surveyName'],
            'responses' => 0,
            'responses_goal' => $data['surveyGoal'],
            'total_view' => 0,
            'today_view' => 0,
            'remainder_view' => 0,
            'current_date' => now(),
            'series' => $initializeJSON,
        ]);
        return  response()->json([
            'result' => $insertSurvey,
            'success' => true,
            'errors' => null
        ]);
    }


    public function storeUserSurvey(Request $request,$projectID)
    {
        $validator = Validator::make($request->all(), [
            'discover' => 'string|required',
            'dissapointed' => 'string|required',
            'reasonDissapoint' => 'string|nullable',
            'alternative' => 'string|required',
            'benefits' => 'string|required',
            'recommendAny' => 'string|required',
            'personBenefit' => 'string|required',
            'improveSuggest' => 'string|required',
            'contacts' => 'string|required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        //Get Survey ID
        $surveyID = DB::table('survey')->where('projectID',$projectID)->value('surveyID');
        $insertUserAnswer = DB::table('user_answer')->insert([
            'surveyID' => $surveyID,
            'discover' => $data['discover'],
            'dissapointed' => $data['dissapointed'],
            'reasonDissapoint' => $data['reasonDissapoint'],
            'alternative' => $data['alternative'],
            'benefits' => $data['benefits'],
            'recommendAny' => $data['recommendAny'],
            'personBenefit' => $data['personBenefit'],
            'improveSuggest' => $data['improveSuggest'],
            'contacts' => $data['contacts'],
        ]);
        $incrementResponse = DB::table('survey')->where('surveyID',$surveyID)->increment('responses');
        return  response()->json([
            'incrementResponse' => $incrementResponse,
            'result' => $insertUserAnswer,
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

    public function updateSeries(Request $request,$projectid){
        $validator = Validator::make($request->all(), [
            'updateSeries' => 'json',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        $updateSeries = DB::table('survey')->where('projectID',$projectid)->update(['series' => $data['updateSeries']]);
        return  response()->json([
            'result' => $updateSeries,
            'success' => true,
            'errors' => null
        ]);
    }

    public function resetUpdateTodayPV(Request $request, $projectid){
        //Update Today Page View
        $validator = Validator::make($request->all(), [
            'newTodayPageView' => 'integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        $updateTodayPageView = DB::table('survey')->where('projectID',$projectid)->update(['today_view' => $data['newTodayPageView']]);
        //Reset Today Page View
        $resetRemainder = DB::table('survey')->where('projectID',$projectid)->update(['remainder_view' => 0]);
        return  response()->json([
            'resultUpdate' => $updateTodayPageView,
            'resultReset' => $resetRemainder,
            'success' => true,
            'errors' => null
        ]);
    }
    
    public function updateCurrentDate(Request $request, $projectid){
        $validator = Validator::make($request->all(), [
            'newCurrentDate' => 'date',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        $updateDate = DB::table('survey')->where('projectID',$projectid)->update(['current_date' => $data['newCurrentDate']]);
        return  response()->json([
            'result' => $updateDate,
            'success' => true,
            'errors' => null
        ]);
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
