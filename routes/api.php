<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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



// Route::name('category.')->controller(CategoryController::class)->group(function(){

//     Route::get('/', 'index');
//     Route::get('/category/{id}', 'show');
//     Route::post('/category/create','create')->name('create');
//     Route::post('/category/update/{id}', 'update')->name('update');
//     Route::get('/category/delete/{id}', 'delete')->name('delete');
// });
