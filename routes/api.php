<?php

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
// Auth routes : Register, login user
Route::post('/register', 'AuthController@register'); // Make user
Route::post('/login', 'AuthController@login'); // Login and get JWT

Route::resource('plan', 'PlanController');
Route::post('/plan/calculate_cost', 'PlanController@calculateCost');
// add middleware for it

Route::post('/user/save_plans', [
    'middleware' => 'check.token.api',
    'uses' => 'UserController@savePlans'
]);

//savePlans
// Override to add middleware('check.token.api')
// As of now we have only 1 user so not using roles functionality now. Just verify JWT

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
