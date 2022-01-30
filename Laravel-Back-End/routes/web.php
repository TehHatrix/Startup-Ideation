<?php

use App\Events\Hello;
use App\Events\TestTry;
use App\Models\FreeCanvas;
use App\Models\FreeCanvasContent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::get('/hypothesis', [HypothesisController::class,'index'])->name('hypothesis');
// Route::get('/hypothesis', function () {
//     return view('hypothesis');
// });


Route::get('/', function () {
    return 'home';
});

Route::get('/test', function() {
    broadcast(new Hello());
});

Route::get('/channel/hello', function() {
    // $content = FreeCanvasContent::where('free_canvas_id', 1)->first();
    // $canvas = $content->canvas()->get();
    // $project = $canvas->project()->get();
    // $userArr = $project->users()->wherePivot('user_id', '=', $user->id)->get();
    // $canvas = FreeCanvas::find(1)->project()->get();
    // $user = 
    // return $user;
});
