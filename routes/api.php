<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
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

// ? Public routes

Route::get('authors', [AuthorController::class, 'index']);
Route::get('authors/{id}', [AuthorController::class, 'show']);
Route::get('books', [BookController::class, 'index']);
Route::get('books/{id}', [BookController::class, 'show']);
Route::post('register', [AuthController::class, 'register']);

// ? protected routes

Route::middleware('auth:sanctum')->group(function(){
    Route::resource('books', BookController::class)->except(
        ['create', 'edit', 'index', 'show']
    );
    Route::post('authors', [AuthorController::class, 'store']);
    Route::put('authors/{id}', [AuthorController::class, 'update']);
    Route::delete('authors/{id}', [AuthorController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
