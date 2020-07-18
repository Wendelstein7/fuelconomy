<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => true, 'verify' => false, 'reset' => false]);

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

Route::resource('vehicles', 'VehicleController')->middleware('auth');
Route::resource('vehicles.refuels', 'VehicleRefuelController')->middleware('auth');

