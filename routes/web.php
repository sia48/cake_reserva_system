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
    return redirect()->route('auth');
});

Route::middleware(['auth:sanctum', 'verified'])->get('CakeReservaSystem', function () {
    return redirect()->route('index');
})->name('auth');

Route::get('/config','App\Http\Controllers\CakeController@config')->name('config');
Route::get('/shop_config','App\Http\Controllers\CakeController@shopConfig')->name('shop_config');
Route::get('/home','App\Http\Controllers\CakeController@index')->name('index');
Route::get('/show','App\Http\Controllers\CakeController@show')->name('show');
Route::get('/detail/{id}','App\Http\Controllers\CakeController@detail')->name('detail');
Route::get('export','App\Http\Controllers\CakeController@export')->name('export');
Route::get('case','App\Http\Controllers\CakeController@case')->name('case');

Route::post('/cakes_import','App\Http\Controllers\CakeController@import')->name('import');
Route::post('/store','App\Http\Controllers\CakeController@store')->name('store');
Route::post('/update/{id}','App\Http\Controllers\CakeController@update')->name('update');
Route::post('/register','App\Http\Controllers\CakeController@register')->name('register');
Route::post('/search','App\Http\Controllers\CakeController@search')->name('search');
Route::post('/user_update','App\Http\Controllers\CakeController@userUpdate')->name('user_update');

Route::delete('/delete/{id}','App\Http\Controllers\CakeController@delete')->name('delete');