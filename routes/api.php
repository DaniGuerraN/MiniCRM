<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LanguageController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::group(['middleware' => ['lang','auth:sanctum']],function () {
    Route::prefix('company')->group(function () {
        Route::get('/',[CompanyController::class,'index']);
        Route::post('/',[CompanyController::class,'store']);
        Route::get('/{company}',[CompanyController::class,'show']);
        Route::put('/{company}',[CompanyController::class,'update']);
        Route::delete('/{company}',[CompanyController::class,'destroy']); 
    });

    Route::prefix('employee')->group(function () {
        Route::get('/',[EmployeeController::class,'index']);
        Route::post('/',[EmployeeController::class,'store']);
        Route::get('/{employee}',[EmployeeController::class,'show']);
        Route::put('/{employee}',[EmployeeController::class,'update']);
        Route::delete('/{employee}',[EmployeeController::class,'destroy']); 
    });


});