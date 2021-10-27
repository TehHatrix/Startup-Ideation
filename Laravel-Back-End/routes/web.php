<?php

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
