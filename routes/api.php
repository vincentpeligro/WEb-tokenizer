<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AlbumControllerAPI;
use App\Http\Controllers\API\AlbumPostController;

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


Route::post('login',[AlbumControllerAPI::class,'login']);
Route::post('register',[AlbumControllerAPI::class,'register']);
Route::post('reset-password',[AlbumControllerAPI::class,'resetPassword']);



Route::get('get-all-posts',[AlbumPostController::class,'getAllPosts']);
Route::get('get-post',[AlbumPostController::class,'getPost']);
Route::get('search-post',[AlbumPostController::class,'searchPost']);
