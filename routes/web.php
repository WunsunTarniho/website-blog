<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::group(['middleware' => 'auth'], function(){
    Route::resource('blog', BlogController::class);
    Route::get('logout', [AuthenticateController::class, 'logout']);
    Route::get('profile', [UserController::class, 'profile']);
    Route::get('myblog', [BlogController::class, 'myblog']);
    Route::get('/post/createSlug', [BlogController::class, 'createSlug']);
    Route::put('/profile/edit', [UserController::class, 'update']);
});

Route::get('login', [AuthenticateController::class, 'index'])->middleware('guest')->name('login');
Route::post('login', [AuthenticateController::class, 'login']);
Route::get('register', [AuthenticateController::class, 'register'])->middleware('guest');
Route::post('register', [UserController::class, 'create'])->middleware('guest');
