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
//Route::post('logout/{user}', [PassportAuthController::class, 'logout']);


Route::middleware('auth:api')->group(function () {
    Route::get('/issues', 'IssuesController@index');
    Route::get('/issues/{id}', 'IssuesController@show');
    Route::get('/issues/by/{user}', 'IssuesController@index');
    Route::get('/issues/create', 'IssuesController@create');
    Route::post('/issues', 'IssuesController@store');
    Route::delete('/issues/{issue}', 'IssuesController@destroy');
    Route::post('/issues/{issue}/resolve', 'IssuesController@edit');
    Route::post('/issues/{issue}/replies', 'RepliesController@store');
    Route::post('/issues/{issue}/rate', 'RatingsController@store');

    Route::get('/Projects', 'ProjectsController@index');
    Route::get('/Projects/{Project}', 'ProjectsController@show');
    Route::get('/Projects/{Project}/units', 'UnitsController@index');

    Route::get('/units', 'UnitsController@index');
    Route::post('/units', 'UnitsController@index');
    Route::get('/units/{unit}', 'UnitsController@show');
    Route::delete('/units/{unit}', 'UnitsController@show');

    Route::get('/tenants', 'TenantsController@index');
    Route::post('/tenants', 'TenantsController@store');
    Route::put('/tenants/{user}', 'TenantsController@update');
    Route::get('/tenants/{user}', 'TenantsController@show');
    Route::delete('/tenants/{user}', 'TenantsController@destroy');

    Route::get('/managers', 'ManagersController@index');
    Route::post('/managers', 'ManagersController@store');
    Route::put('/managers/{user}', 'ManagersController@update');
    Route::get('/managers/{user}', 'ManagersController@show');
    Route::get('/managers/{manager}/project', 'ManagerDetailsController@index');
    Route::delete('/managers/{user}', 'ManagersController@destroy');


    Route::post('/users/{user}/change-password', 'PasswordController@update');
    Route::post('logout', [PassportAuthController::class, 'logout']);


});
