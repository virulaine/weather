<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AuthController;

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

Route::group(['prefix' => 'v1'], function () use ($router) {
    $router->post('/register', [AuthController::class, 'register']);
    $router->post('/login', [AuthController::class, 'login']);
    $router->get(
        '/login',
        function () {
            return "Token is wrong";
        }
    )->name('login');
});

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'v1'], function () use ($router) {
    $router->get('/cities', [CityController::class, 'list']);
    $router->get('/city/{id}', [CityController::class, 'show']);
    $router->post('/city', [CityController::class, 'save']);
});
