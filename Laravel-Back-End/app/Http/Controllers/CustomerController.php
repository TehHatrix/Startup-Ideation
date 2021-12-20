<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($interviewID)
    {
        $customerData = DB::table('customer')->where('interview_ID', '=', $interviewID)->get();
        return $customerData;
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
    public function store(Request $request, $interviewID)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'occupation' => 'string|required',
            'email' => 'string|required',
            'phone' => 'string|required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        $insertCustomer = DB::table('customer')->insert([
            'interview_ID' => $interviewID,
            'custname' => $data['name'],
            'custscore' => 0.00,
            'custocc' => $data['occupation'],
            'cust_phone_num' => $data['phone'],
            'custemail' => $data['email'],
            'logs' => "",
        ]);
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
    public function update(Request $request, $custid)
    {
        $validator = Validator::make($request->all(), [
            'currentEditedOcc' => 'string|nullable',
            'currentEditedPhone' => 'string|nullable',
            'currentEditedEmail' => 'string|nullable',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        $updateDetails = [
            'custocc' => $data['currentEditedOcc'],
            'cust_phone_num' => $data['currentEditedPhone'],
            'custemail' => $data['currentEditedEmail']

        ]; 
        $updateScript = DB::table('customer')
            ->where('cust_ID', '=', $custid)
            ->update($updateDetails);
        return  response()->json([
            'success' => true,
            'errors' => null
        ]);
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
