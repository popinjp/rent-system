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

Route::get('/', function () {
    return view('welcome');
});
Route::get('rent/resident', 'ResidentController@index');
Route::get('rent/resident/add', 'ResidentController@add');
Route::post('rent/resident/add', 'ResidentController@create');
Route::get('rent/resident/edit', 'ResidentController@edit');
Route::post('rent/resident/edit', 'ResidentController@update');
Route::get('rent/resident/delete', 'ResidentController@delete');
Route::post('rent/resident/delete', 'ResidentController@remove');

Route::get('rent/room', 'RoomController@index');
Route::get('rent/room/add', 'RoomController@add');
Route::post('rent/room/add', 'RoomController@create');
Route::get('rent/room/edit', 'RoomController@edit');
Route::post('rent/room/edit', 'RoomController@update');
Route::get('rent/room/delete', 'RoomController@delete');
Route::post('rent/room/delete', 'RoomController@remove');

Route::get('rent/water-rate', 'WaterRateController@index');
Route::get('rent/water-rate/add', 'WaterRateController@add');
Route::post('rent/water-rate/add', 'WaterRateController@create');
Route::get('rent/water-rate/edit', 'WaterRateController@edit');
Route::post('rent/water-rate/edit', 'WaterRateController@update');
Route::get('rent/water-rate/delete', 'WaterRateController@delete');
Route::post('rent/water-rate/delete', 'WaterRateController@remove');

Route::get('rent/water-bill', 'WaterBillController@index');
Route::get('rent/water-bill/add', 'WaterBillController@add');
Route::post('rent/water-bill/add', 'WaterBillController@create');
Route::get('rent/water-bill/edit', 'WaterBillController@edit');
Route::post('rent/water-bill/edit', 'WaterBillController@update');
Route::get('rent/water-bill/delete', 'WaterBillController@delete');
Route::post('rent/water-bill/delete', 'WaterBillController@remove');

Route::get('board', 'BoardController@index');
Route::get('board/add', 'BoardController@add');
Route::post('board/add', 'BoardController@create');
