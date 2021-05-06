<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\EmployeeController;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('department', [EmployeeController::class, 'department']);

Route::get('employeeList/{department_id?}', [EmployeeController::class, 'employeeList']);

Route::post('employeeList', [EmployeeController::class, 'employeeList']);
Route::post('addemployee', [EmployeeController::class, 'addemployee']);

Route::post('transferEmployee', [EmployeeController::class, 'transferEmployee']);
Route::post('removeEmployee', [EmployeeController::class, 'removeEmployee']);
     
Route::middleware('auth:api')->group( function () {
    Route::resource('employees', EmployeeController::class);
});