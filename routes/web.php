<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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
    return view('landingpage');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/home', function () {
    return view('user_dashboard/dashboard');
})->name('home')->middleware('auth');

Route::post('/login',[LoginController::class,'login'])->name('loginCheck');

Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/user-list',[UserController::class,'index'])->name('user-list')->middleware('auth');

Route::get('/add-user',[UserController::class,'addUser'])->name('add-user')->middleware('auth');

Route::post('/add-user',[UserController::class,'addUser'])->name('add-user')->middleware('auth');

Route::get('/edit-user/{id}',[UserController::class,'editUser'])->name('edit-user')->middleware('auth');

Route::post('/update-user/{id}',[UserController::class,'UpdateUser'])->name('update-user')->middleware('auth');

Route::get('/delete/{id}',[UserController::class,'deleteUser'])->name('delete-user')->middleware('auth');
