<?php

use App\Http\Controllers\api\v1\ArticleController;
use App\Http\Controllers\api\v1\CategoryController;
use App\Http\Controllers\api\v1\LoginController;
use App\Http\Controllers\api\v1\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:api');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('category' , [CategoryController::class, 'index']);
    Route::post('category/store', [CategoryController::class, 'store']);
    Route::get('category/{id}', [CategoryController::class, 'show']);
    Route::post('category/update/{id}', [CategoryController::class, 'update']);
    Route::delete('category/destroy/{id}', [CategoryController::class, 'destroy']);

    Route::get('article' , [ArticleController::class, 'index']);
    Route::post('article/store', [ArticleController::class, 'store']);
    Route::get('article/{id}', [ArticleController::class, 'show']);
    Route::post('article/update/{id}', [ArticleController::class, 'update']);
    Route::delete('article/destroy/{id}', [ArticleController::class, 'destroy']);
});