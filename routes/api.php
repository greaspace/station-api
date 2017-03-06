<?php

//use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$router = app('Dingo\Api\Routing\Router');
$router->version('v1', ['namespace' => 'App\Http\Controllers'], function ($router) {
    $router->get('/', 'TestController@orders');
});
