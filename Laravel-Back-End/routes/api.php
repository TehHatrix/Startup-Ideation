<?php

use App\Events\communication\ChatUpdated;
use App\Events\TestTry;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerProblemController;
use App\Http\Controllers\FreeCanvasContentController;
use App\Http\Controllers\FreeCanvasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HypothesisController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LeanCanvasController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\TodoController;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use Symfony\Component\Mime\MessageConverter;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/getproblemswithcustSeg/{projectID}', [HypothesisController::class, 'getproblemswithcustSeg']);
Route::get('/gethypothesis', [HypothesisController::class, 'gethypothesisdata']);
Route::get('/getproblemHypothesis/{projectID}', [HypothesisController::class, 'getproblemHypothesis']);
Route::get('/getinterviewIDbyHypothesis/{hypothesisID}', [HypothesisController::class, 'getinterviewIDbyHypothesis']);

Route::get('/getcustomersegmentstopic', [HypothesisController::class, 'getCustomerSegmentsTopic']);
Route::get('/getproblemstopic', [HypothesisController::class, 'getProblemsTopic']);
Route::get('/getstatus/{customerproblem_id}', [HypothesisController::class, 'getstatus']);
Route::get('/getHypothesisID/{customerproblem_id}', [HypothesisController::class, 'getHypothesisID']);
Route::prefix('/hypothesis')->group(function () {
    Route::post('/store', [HypothesisController::class, 'store']);
    Route::get('/checkvalidate/{projectID}', [HypothesisController::class, 'checkHypothesisValidate']);
    Route::put('/validate/{interviewID}', [HypothesisController::class, 'setHypothesisTrue']);
    Route::put('/update/{hypothesisID}', [HypothesisController::class, 'updateHypothesis']);
    Route::put('/custprobid/{customerproblem_id}/{tablenumber}/{table}', [HypothesisController::class, 'updateCustomerProblem']);
    Route::delete('/custprob/{customerproblem_id}', [HypothesisController::class, 'destroy']);
    Route::delete('/delete/{hypothesisID}', [HypothesisController::class, 'deleteHypothesis']);

});


Route::prefix('/interview')->group(function () {
    Route::get('/index/{id}', [InterviewController::class, 'index']);
    Route::post('/store', [InterviewController::class, 'store']);
    Route::post('/updatescript/{interviewID}', [InterviewController::class, 'updateScript']);
    // Route::put('/{id}', [HypothesisController::class,'update']);
    // Route::put('/custprobid/{customerproblem_id}/{tablenumber}/{table}', [HypothesisController::class,'updateCustomerProblem']);
    // Route::delete('/custprob/{customerproblem_id}',[HypothesisController::class,'destroy']);
});

Route::prefix('/customer')->group(function () {
    Route::get('/index/{id}', [CustomerController::class, 'index']);
    Route::post('/store/{interviewid}', [CustomerController::class, 'store']);
    Route::post('/update/{custID}', [CustomerController::class, 'update']);
    Route::post('/update/{custID}/score', [CustomerController::class, 'updateScore']);
    Route::post('/update/{custID}/logs', [CustomerController::class, 'updateLog']);
    Route::delete('/delete/{custID}', [CustomerController::class, 'deleteCustomer']);
    // Route::post('/updatescript/{interviewID}', [CustomerController::class, 'updateScript']);
    // Route::put('/{id}', [HypothesisController::class,'update']);
    // Route::put('/custprobid/{customerproblem_id}/{tablenumber}/{table}', [HypothesisController::class,'updateCustomerProblem']);
    // Route::delete('/custprob/{customerproblem_id}',[HypothesisController::class,'destroy']);
});

Route::prefix('/landing')->group(function () {
    Route::get('/index/{projectID}',[LandingController::class,'index']);
    Route::post('/store/{projectID}', [LandingController::class, 'store']);
    Route::put('/update/{projectID}',[LandingController::class, 'update']);
    Route::put('/updateGoalName/{projectID}',[LandingController::class, 'updateGoalName']);
    Route::put('/updateseries/{projectID}',[LandingController::class, 'updateSeries']);
    Route::put('/updatecurrentdate/{projectID}',[LandingController::class, 'updatecurrentdate']);
    Route::put('/updatetodaypageview/{projectID}',[LandingController::class, 'updateTodayPageView']);
    Route::put('/resetremainderpageview/{projectID}',[LandingController::class, 'resetRemainder']);
    Route::put('/handlerevenuesignup/{projectID}',[LandingController::class, 'handleRevenueSignup']);
    Route::put('/incrementtodaypageview/{projectID}',[LandingController::class, 'incrementTodayPageView']);
    Route::put('/incrementtotalpageview/{projectID}',[LandingController::class, 'incrementTotalPageView']);
    Route::put('/incrementremainderpageview/{projectID}',[LandingController::class, 'incrementRemainderPageView']);
    Route::put('/validate/{projectID}',[LandingController::class, 'setValidated']);
    Route::get('/checkexistproject/{projectID}',[LandingController::class,'checkExistLandingProject']);
    Route::get('/checkvalidate/{projectID}',[LandingController::class,'checkValidated']);

    Route::delete('/delete/{projectID}', [LandingController::class, 'delete']);
    //Adopter Table
});

Route::prefix('/survey')->group(function (){
    Route::get('/checkexistproject/{projectID}',[SurveyController::class,'checkExistSurveyProject']);
    Route::get('/index/{projectID}',[SurveyController::class,'index']);
    Route::get('/indexuseranswer/{projectID}',[SurveyController::class,'getUserAnswer']);
    Route::post('/store/{projectID}', [SurveyController::class, 'store']);
    Route::post('/storeUserSurvey/{projectID}', [SurveyController::class, 'storeUserSurvey']);
    Route::put('/updategoalname/{projectID}',[SurveyController::class, 'updateGoalName']);
    Route::put('/updateseries/{projectID}',[SurveyController::class, 'updateSeries']);
    Route::put('/resetupdatetpw/{projectID}',[SurveyController::class, 'resetUpdateTodayPV']);
    Route::put('/updatedate/{projectID}',[SurveyController::class, 'updateCurrentDate']);
    Route::put('/incrementtotalpageview/{projectID}',[SurveyController::class, 'incrementTotalPageView']);
    Route::put('/incrementremainderpageview/{projectID}',[SurveyController::class, 'incrementRemainderPageView']);
    Route::put('/incrementtodaypageview/{projectID}',[SurveyController::class, 'incrementTodayPageView']);
    Route::delete('/delete/{projectID}', [SurveyController::class, 'delete']);
    Route::put('/validate/{projectID}',[SurveyController::class, 'setValidated']);
    Route::get('/checkvalidate/{projectID}',[SurveyController::class,'checkValidated']);
});



// auth 
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::delete('/logout', [AuthController::class, 'logout']);

// project module 
Route::group([
    'middleware' => 'auth:sanctum'
], function () {

    Route::resource('/projects', ProjectController::class)->except([
        'create',
        'edit'
    ]);
    Route::get('/projects/validationphase/{projectId}',[ProjectController::class, 'getValidationPhase']);
    Route::put('/projects/setvalidation/{projectId}',[ProjectController::class, 'setValidationPhase']);
    // To do List Route
    Route::resource('projects.todos', TodoController::class)->except([
        'create',
        'edit'
    ]);
    
    // lean canvas route
    Route::post('/projects/{projectID}/leancanvas', [LeanCanvasController::class, 'addContent']);
    Route::get('/projects/{projectID}/leancanvas', [LeanCanvasController::class, 'index']);
    Route::delete('/projects/leancanvas/{contentType}/{contentId}', [LeanCanvasController::class, 'deleteContent']);
    Route::put('/projects/leancanvas/{contentType}/{contentId}', [LeanCanvasController::class, 'updateContent']);


    // collaborator
    Route::put('/getUser/{projectId}', [ProjectController::class, 'addCollab']);
    Route::put('/deleteUser/{projectId}', [ProjectController::class, 'removeCollab']);
    
    // free canvas route
    Route::apiResource('projects.free-canvas', FreeCanvasController::class);
    // Route::apiResource('free-canvas.content', FreeCanvasContentController::class);
    Route::get('free-canvas/{canvasId}/content', [FreeCanvasContentController::class, 'show']);
    Route::put('free-canvas/{canvasId}/content', [FreeCanvasContentController::class, 'update']);
    
    // communication route
    //   -> announcement 
    Route::get('/projects/{projectId}/announcement', [AnnouncementController::class, 'index']);
    Route::post('/projects/{projectId}/announcement', [AnnouncementController::class, 'store']);
    Route::put('/projects/{projectId}/announcement/{announcementId}', [AnnouncementController::class, 'update']);
    Route::delete('projects/{projectId}/announcement/{announcementId}', [AnnouncementController::class, 'destroy']);
    
    // -> project chat
    Route::get('/projects/{projectId}/message', [MessageController::class, 'index']);
    Route::post('/projects/{projectId}/message', [MessageController::class, 'store']);
    Route::delete('/projects/{projectId}/message/{messageId}', [MessageController::class, 'destroy']);
});

// test route
Route::get('/channel/test', function() {
    // broadcast(new ChatUpdated());
    return 'success';
});

Route::get('/test/channel', function() {
    broadcast(new TestTry());
});

Broadcast::routes(['middleware' => ['auth:sanctum']]);

// delete this later
Route::get('/test', function() {
    $project = Project::find(1);
    $user = $project->users()->wherePivot('user_id', '=', '2')->get();

    return $user[0]->id;
});