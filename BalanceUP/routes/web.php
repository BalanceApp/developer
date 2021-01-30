<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Condition;
use App\Http\Controllers\UserCtrl;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\StaffController;

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
Route::get('/', function(){
    return view('index');
});

Route::get('/player', function () {
    return view('login_player');
});
Route::post('/login-player', [PlayerController::class, 'login']);

Route::get('/register-player', function () {
    return view('register_player');
});
Route::post('/store-player', [PlayerController::class, 'store']);


Route::get('/toscreen', function(){
    return view('sub_item_page');
});

Route::get('/daily-body-record', function (){
    return view('daily_body_record');
});
Route::post('/input-daily-body-record', [Condition::class, 'inputDailyBodyRecord']);

Route::get('/regular-record',function (){
    return view("regular_body_record");
});
Route::post('/input-regular-body-record', [Condition::class, 'inputRegularBodyRecord']);
Route::post('/input-nutrition-score', [Condition::class,'inputNutritionScore']);
Route::get('/finish-inputing' , function(){
    return view('finish_inputing_1');
});

Route::get('/history',[Condition::class,'setResult']);
Route::get('/get-nutrition-score', [Condition::class,'getNutritionScore']);
Route::get('/view-body-graph', [Condition::class,'setBodyGraph']);
Route::get('/get-graph-data', [Condition::class, 'getGraphData']);



Route::get('/view-body-graph/{userid}',  function($userid){
    $userid=$userid;
    return view('body_graph',compact('userid'));
});
Route::get('/result/{userid}',function($userid){
    $userid=$userid;
    return view('result',compact('userid'));
});

Route::get('/staff', function () {
    return view('login_staff');});
Route::post('/login-staff', [StaffController::class, 'login']);
Route::get('/register-staff', function () {
    return view('register_staff');
});
Route::post('/store-staff', [StaffController::class, 'store']);
Route::get('/staff-page', function(){
    return view('staff_page');
});
Route::get('/playerlist', [PlayerController::class, 'index']);
Route::get('/outputCSV' ,[UserCtrl::class,'csvOut']);
Route::post('/saveCSV', [Condition::class,'csvSave']);

Route::get('/indiv1', [UserCtrl::class, 'getplayerList']);
Route::get('/indiv2', [UserCtrl::class, 'getplayerList']);
Route::get('/nextMeal', function(){
    return view("nextMeal");
});
Route::post('/savenextMeal', [Condition::class,'nextMeal']);
Route::post('/saveSixValues', [Condition::class,'saveEvaluateValues']); 