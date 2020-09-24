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

use App\Http\Controllers\WheatherController;
use App\Http\Controllers\OrdersController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('wheather', 'WheatherController@index')->name('wheather');

Route::resource('orders', 'OrdersController', [
    'only' => ['index', 'edit', 'update']
]);