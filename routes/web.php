<?php

use App\Http\Controllers\CategoryController;
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
    return view('welcome');
});



Route::name('category.')->controller(CategoryController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    Route::post('/category/create','create')->name('create');
    Route::put('/category/update/{id}', 'update')->name('update');
    Route::delete('/category/delete/{id}', 'delete')->name('delete');

});
