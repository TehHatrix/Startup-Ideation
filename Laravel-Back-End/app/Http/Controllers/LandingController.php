<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $landing = DB::table('landing_pages')->get();
        return response()->json([
            'success' => true,
            'data' => $landing,
        ]);




    }

    public function checkExistLandingProject($projectID){
        $searchProjectID = DB::table('landing_pages')->where('projectID','=',$projectID)->exists();
        return $searchProjectID;
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
            'html' => 'string|nullable',
            'css' => 'string|nullable',
            'landingName' => 'string|required',
            'landingRevGoal' => 'numeric|required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        $insertLandingPage = DB::table('landing_pages')->insert([
            'projectID' => $projectID,
            'landingHTML' => $data['html'],
            'landingCSS' => $data['css'],
            'landingName' => $data['landingName'],
            'target_revenue' => $data['landingRevGoal'],
            'sign_ups' => 0,
            'unique_view' => 0,
            'expected_revenue' => 0,
        ]);
        return  response()->json([
            'success' => true,
            'errors' => null
        ]);

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
