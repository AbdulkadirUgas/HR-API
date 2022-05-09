<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/empInfo',[EmployeeController::class,'empInfo']);

Route::get('/employees',[EmployeeController::class,'index']);
Route::post('/employee',[EmployeeController::class,'store']);
Route::get('/employee/{id}',[EmployeeController::class,'show']);
Route::put('/employee/{id}',[EmployeeController::class,'update']);
Route::delete('/employee/{id}',[EmployeeController::class,'destroy']);

//attendance routes
Route::get('/attendances',[AttendanceController::class,'index']);
Route::post('/attendance',[AttendanceController::class,'store']);
Route::get('/attendance/{id}',[AttendanceController::class,'show']);
Route::get('/attendance/search/{date}',[AttendanceController::class,'searchByDate']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
