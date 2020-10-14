<?php

use App\Helpers\CurlHelper;
use Illuminate\Http\Request;
use Amp\Parallel\Worker;
use Amp\Promise;

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

Route::get('/test', function () {
    // CurlHelper::curl('https://www.google.com');
    $res = [];
    $urls = [
        'https://reqres.in/api/users?page=2',
        'https://reqres.in/api/users/2',
        'https://reqres.in/api/unknown',
        'https://reqres.in/api/unknown/2',
        'https://reqres.in/api/unknown/23',
        'https://reqres.in/api/users?delay=3',
        'https://reqres.in/api/users/3',
        'https://reqres.in/api/users/5',
    ];

    $promises = [];
    foreach ($urls as $url) {
        $promises[$url] = Worker\enqueueCallable('file_get_contents', $url);
    }

    $responses = Promise\wait(Promise\all($promises));

    foreach ($responses as $url => $response) {
        $res [] = $response;
    }
    return $res;
});
Route::get('/testJson', function () {
    return \App\Helpers\HotelHelper::json($type = 'both');
});
Route::namespace('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/searchHotels/{type}', 'HotelController@searchHotels');
