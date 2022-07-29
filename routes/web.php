<?php

use App\Http\Controllers\CategoryController;
use App\Models\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $images = File::get(['image_base64']);
    return view('welcome', compact('images'));
});



// Route::name('category.')->controller(CategoryController::class)->group(function(){



// });
// Route::apiResource('/category', CategoryController::class);
