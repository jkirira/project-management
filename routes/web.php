<?php

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

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');


//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//
//
//Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');
//
//Route::get('/units', 'UnitsController@index');
//Route::get('/units/{id}', 'UnitsController@show');
//
////Route::get('/tds', 'TenantDetailsController@index');
//
