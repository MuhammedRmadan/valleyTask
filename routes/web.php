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
Route::get('/test', function () {
    if (array_key_exists('hotelFare', \Illuminate\Support\Facades\Config::get('providersAttributes'))) {
        return \Illuminate\Support\Facades\Config::get('providersAttributes')['hotelFare'];
    }
    return 'no';
});
