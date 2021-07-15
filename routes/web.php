<?php

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


Route::get('/',function(){
    return view('login');
})->name('/');

Route::get('login',function(){
    return view('login');
})->name('login');

Route::get('dashboard',[App\Http\Controllers\HomeController::class,'dashboard'])->name('dashboard');

Route::get('users',[App\Http\Controllers\UserController::class,'index'])->name('users');
Route::delete('user/delete/{userId}',[App\Http\Controllers\UserController::class,'delete']);
Route::post('user/update',[App\Http\Controllers\UserController::class,'update'])->name('user/update');

Route::get('url/create',[App\Http\Controllers\ShortenUrlController::class,'create'])->name('url/create');
Route::post('url/create-update',[App\Http\Controllers\ShortenUrlController::class,'createOrUpdateUrl'])->name('url/create-update');
Route::delete('url/delete/{urlId}',[App\Http\Controllers\ShortenUrlController::class,'delete']);
Route::get('url/{shortURL}',[App\Http\Controllers\ShortenUrlController::class,'redirectURL']);
Route::get('short-urls',[App\Http\Controllers\ShortenUrlController::class,'index'])->name('short-urls');

Route::get('user/register',[App\Http\Controllers\LoginController::class,'register'])->name('user/register');
Route::post('user/request/save',[App\Http\Controllers\LoginController::class,'storeRegister'])->name('user/request/save');

Route::get('user/login/view/new',[App\Http\Controllers\LoginController::class,'viewLogin'])->name('user/login/view/new');
Route::post('user/login',[App\Http\Controllers\LoginController::class,'login'])->name('user/login');
Route::get('user/logout',[App\Http\Controllers\LoginController::class,'logout'])->name('user/logout');

