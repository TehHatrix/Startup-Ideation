<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
            'image' => 'image|nullable'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $file = $request->file('image');
        $data = $validator->validated();
        if ($file == null) {
            $url = "https://storage.googleapis.com/startup-ideation/customer-pictures/default/logo.png";
        } else {
            /** @var \Illuminate\Filesystem\FilesystemManager $disk */
            $disk = Storage::disk('gcs');
            $file = $request->file('image');
            $appendImage = $disk->put('customer-pictures', $file);
            $fileName = basename($appendImage);
            $folderFileName = "customer-pictures/" . $fileName;
            $url = $disk->url($folderFileName);
        }
        $insertCustomer = DB::table('customer')->insert([
            'interview_ID' => $interviewID,
            'custname' => $data['name'],
            'custscore' => 0.00,
            'custocc' => $data['occupation'],
            'cust_phone_num' => $data['phone'],
            'custemail' => $data['email'],
            'image_path' => $url,
            'logs' => "",
        ]);
        $averageScoreCustomers = DB::table('customer')->where('interview_ID', $interviewID)->avg('custscore');
        $updateDetailsInterviewScore = [
            'overall_score' => $averageScoreCustomers
        ];
        $updateInterviewOverallScore = DB::table('interview')->where('interview_ID', $interviewID)->update($updateDetailsInterviewScore);
        return  response()->json([
            'insertCustomer' => $insertCustomer,
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
            'custname' => 'string|nullable',
            'custocc' => 'string|nullable',
            'cust_phone_num' => 'string|nullable',
            'custemail' => 'string|nullable',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        if(sizeof(array_filter($data)) != 0){
            $updateData = DB::table('customer')
            ->where('cust_ID', '=', $custid)
            ->update(array_filter($data));
        }
        $file = $request->file('custimage');
        if ($file != null) {
            /** @var \Illuminate\Filesystem\FilesystemManager $disk */
            $disk = Storage::disk('gcs');
            $file = $request->file('custimage');
            $appendImage = $disk->put('customer-pictures', $file);
            $fileName = basename($appendImage);
            $folderFileName = "customer-pictures/" . $fileName;
            $url = $disk->url($folderFileName);
            $updateImage = DB::table('customer')
            ->where('cust_ID', '=', $custid)
            ->update(["image_path" => $url]);
        }
        return  response()->json([
            'success' => true,
            'errors' => null
        ]);
    }

    public function updateScore(Request $request, $custid)
    {
        $validator = Validator::make($request->all(), [
            'score' => 'required|between:0,99.99',
            'interviewID' => 'integer|required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        $updateDetails = [
            'custscore' => $data['score'],
        ];
        $updateScore = DB::table('customer')
            ->where('cust_ID', '=', $custid)
            ->update($updateDetails);
        $averageScoreCustomers = DB::table('customer')->where('interview_ID', $data['interviewID'])->avg('custscore');
        $updateDetailsInterviewScore = [
            'overall_score' => $averageScoreCustomers
        ];
        $updateInterviewOverallScore = DB::table('interview')->where('interview_ID', $data['interviewID'])->update($updateDetailsInterviewScore);

        return  response()->json([
            'averageCustomerScore' => $averageScoreCustomers,
            'updateCustomerScore' => $updateScore,
            'updateInterviewScore' => $updateInterviewOverallScore,
            'success' => true,
            'errors' => null
        ]);
    }

    public function updateLog(Request $request, $custid)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'string|nullable'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        $updateDetails = [
            'logs' => $data['text'],
        ];
        $updateScript = DB::table('customer')
            ->where('cust_ID', '=', $custid)
            ->update($updateDetails);
        return  response()->json([
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
    public function deleteCustomer($customerid)
    {
        $interviewID = DB::table('customer')->where('cust_ID', '=', $customerid)->value('interview_ID');
        DB::table('customer')->where('cust_ID', '=', $customerid)->delete();
        $averageScoreCustomers = DB::table('customer')->where('interview_ID', $interviewID)->avg('custscore');
        if ($averageScoreCustomers == NULL) {
            $updateDetailsInterviewScore = [
                'overall_score' => 0.0
            ];
        } else {
            $updateDetailsInterviewScore = [
                'overall_score' => $averageScoreCustomers
            ];
        }

        $updateInterviewOverallScore = DB::table('interview')->where('interview_ID', $interviewID)->update($updateDetailsInterviewScore);
        return response()->json(['success' => true, 'message' => 'successfully deleted']);
    }
}
