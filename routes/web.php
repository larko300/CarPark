<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::resource('car', 'CarController', [
    'except' => [ 'show', 'delete' ]
]);

Route::resource('carpark', 'CarParkController', [
    'except' => [ 'show' ]
]);

Route::delete('car/{car}', 'CarController@destroy')->name('car.destroy')->middleware('role:manager');

Route::get('/home', 'HomeController@index')->name('home');
