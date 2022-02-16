<?php

use App\Http\Controllers\PassportAuthController;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
Route::get('/issues', 'IssuesController@index');
Route::get('/issues/{id}', 'IssuesController@show');

Route::middleware('auth:api')->group(function () {
    Route::get('/issues/create', 'IssuesController@create');
    Route::post('/issues', 'IssuesController@store');
    Route::delete('/issues/{issue}', 'IssuesController@destroy');
    Route::post('/issues/{issue}/replies', 'RepliesController@store');

    Route::get('/units', 'UnitsController@index');
    Route::post('/units', 'UnitsController@index');
    Route::get('/unit/{id}', 'UnitsController@show');
    Route::delete('/unit/{id}', 'UnitsController@show');

    Route::get('/tenants', 'TenantsController@index');
    Route::post('/tenants', 'TenantsController@store');
    Route::put('/tenants/{user}', 'TenantsController@update');
    Route::get('/tenants/{user}', 'TenantsController@show');
    Route::delete('/tenants/{user}', 'TenantsController@destroy');

    Route::get('/managers', 'ManagersController@index');
    Route::post('/managers', 'ManagersController@store');
    Route::put('/managers/{user}', 'ManagersController@update');
    Route::get('/managers/{user}', 'ManagersController@show');
    Route::delete('/managers/{user}', 'ManagersController@destroy');

    Route::post('logout', [PassportAuthController::class, 'logout']);


});