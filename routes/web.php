<?php

use App\Models\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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
    // $images = File::get(['image_base64']);
    // $notifications = auth()->user()->unreadNotifications;
    // dd($notifications);
    // return view('home', compact('images', 'notifications'));
    return redirect('home');
});



// Route::name('category.')->controller(CategoryController::class)->group(function(){



// });
// Route::apiResource('/category', CategoryController::class);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', function() {
    $images = File::get(['image_base64']);
    if(auth()->user()){
        $notifications = auth()->user()->unreadNotifications;
    } else {
        $notifications = [];
    }
    return view('home', compact('images', 'notifications'));
    // return response()->json($notifications);

})->name('home');
