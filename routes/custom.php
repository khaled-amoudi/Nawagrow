<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\TopicNotificationController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication Routes
Route::controller(UserController::class)->group(function() {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register')->name('register');
    Route::post('logout', 'logout')->name('logout');
});



// Authentication Routes
Route::middleware(['throttle:60,1', 'Language', 'auth:sanctum', 'CheckAdmin'])->group(function () { // use throttle to define the maximum number of requests per minute
    Route::apiResource('/category', CategoryController::class);

    Route::apiResource('/part', PartController::class);

});

Route::get('helpers', function(){
    return url_info();
})->name('helpers');

Route::post('upload', [FileController::class, 'uploadFile'])->name('upload');

Route::get('notification/{topic_id}', [TopicNotificationController::class, 'send']);
// category.index  [GET]
// category.store [POST]
// category.show [GET]
// category.update [PUT]
// category.destroy [DELETE]
