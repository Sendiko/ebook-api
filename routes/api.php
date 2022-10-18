<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;

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

//! option 1
// ? Route::get('me', [AuthController::class, 'me']);
// ? Route::get('book', [BookController::class, 'index']);
// ? Route::get('book/{id}', [BookController::class, 'show']);
// ? Route::post('book', [BookController::class, 'store']);
// ? Route::put('book/{id}', [BookController::class, 'update']);
// ? Route::delete('book/{id}', [BookController::class, 'destroy']);

//! option 2
Route::resource('books', BookController::class)->except(
    ['create', 'edit']
);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
