<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TweetController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum'])->delete('logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();

    return response()->json( 'Logged out',200);
});
Route::post('/login',[ProfileController::class,'store']);
Route::post('/register',[ProfileController::class,'create']);

Route::post('/tweets',[TweetController::class,'store']);
Route::get('/tweets', [TweetController::class,'index']);
Route::get('/tweets/{tweet}',[TweetController::class,'show']);
Route::get('/profile/{user}', [ProfileController::class,'show']);
Route::get('/profile/{user}/tweets',[ProfileController::class,'index']);
