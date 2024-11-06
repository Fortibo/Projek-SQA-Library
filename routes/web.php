<?php

use App\Http\Controllers\LoginController;
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
    return view('login');
})->name('login.show')->middleware('guest');
Route::get('/signup',function(){
    return view('signup');
})->middleware('guest');
Route::middleware('auth')->group(function(){
    Route::get('/user',function(){
        return view('user');
    })->name('user');
    Route::get('/admin',function(){
        return view('admin');
    })->name('admin');

    Route::post('/logout',[LoginController::class,'logout'])->name('logout');   
});
Route::post('/',[LoginController::class,'auth'])->name('login');
Route::post('/signup',[LoginController::class,'create'])->name('signup');   

