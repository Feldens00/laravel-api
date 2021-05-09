<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;

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

// List peoples
Route::get('peoples', [PeopleController::class, 'index']);

// List single people
Route::get('people/{id}', [PeopleController::class, 'show']);

// Create new people
Route::post('people', [PeopleController::class, 'store']);

// Update people
Route::post('people/{id}', [PeopleController::class, 'update']);

// Delete people
Route::delete('people/{id}', [PeopleController::class, 'destroy']);
