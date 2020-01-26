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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get("/","dynamicAuthController@loginShow")->name('login');
Route::get("login","dynamicAuthController@loginShow")->name('login');
Route::post("login","dynamicAuthController@loginDo")->name('loginDo');
Route::get("logout","dynamicAuthController@logOut")->name('logOut');
// Route::group(['middleware'=>['auth:web']],function() {

Route::group(['middleware' => ['DynamicAuth']],function (){
    Route::get("dashboard","DashboardController@home")->name('home');
});

Route::get("dashboard2","DashboardController@home2");
