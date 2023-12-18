<?php

use App\Models\article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;


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


Route::post('login',[AuthController::class ,'login']);
Route::post('register',[AuthController::class ,'register']);


Route::group(['middleware'=>'auth:sanctum'] ,function () {
    Route::resource('articles',ArticleController::class)->except('create','delete','edit');
    Route::get('logout',[AuthController::class ,'logout']);
    
});
Route::resource('articles',ArticleController::class)->only('index','show');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


