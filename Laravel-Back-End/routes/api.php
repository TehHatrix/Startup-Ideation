<?php

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
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TodoController;

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


Route::get('/getproblemswithcustSeg', [HypothesisController::class, 'getproblemswithcustSeg']);
Route::get('/gethypothesis', [HypothesisController::class, 'gethypothesisdata']);
Route::get('/getproblemHypothesis', [HypothesisController::class, 'getproblemHypothesis']);
Route::get('/getinterviewIDbyHypothesis/{hypothesisID}', [HypothesisController::class, 'getinterviewIDbyHypothesis']);

Route::get('/getcustomersegmentstopic', [HypothesisController::class, 'getCustomerSegmentsTopic']);
Route::get('/getproblemstopic', [HypothesisController::class, 'getProblemsTopic']);
Route::get('/getstatus/{customerproblem_id}', [HypothesisController::class, 'getstatus']);
Route::get('/getHypothesisID/{customerproblem_id}', [HypothesisController::class, 'getHypothesisID']);
Route::prefix('/hypothesis')->group(function () {
    Route::post('/store', [HypothesisController::class, 'store']);
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
    Route::get('/checkexistproject/{projectID}',[LandingController::class,'checkExistLandingProject']);
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
    Route::apiResource('free-canvas.content', FreeCanvasContentController::class);

    // communication route
    //   -> announcement 
    Route::get('/projects/{projectId}/announcement', [AnnouncementController::class, 'index']);
    Route::post('/projects/{projectId}/announcement', [AnnouncementController::class, 'store']);
    Route::put('/projects/{projectId}/announcement/{announcementId}', [AnnouncementController::class, 'update']);
    Route::delete('projects/{projectId}/announcement/{announcementId}', [AnnouncementController::class, 'destroy']);

    
});


