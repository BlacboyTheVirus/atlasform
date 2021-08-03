<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PrintController;


Route::get('/', function () {
    return view('welcome');
});




Route::post('/auth/save', [MainController::class, 'save'])->name('auth.save');
Route::post('/auth/check', [MainController::class, 'check'])->name('auth.check');
Route::get('/auth/logout', [MainController::class, 'logout'])->name('auth.logout');




Route::group(['middleware'=> ['AuthCheck']],function(){
    Route::get('/form', [FormController::class, 'index'])->name('form');
    Route::post('/form', [FormController::class, 'store'])->name('form');

    Route::get('/print', [PrintController::class, 'index'])->name('print');

    Route::get('/auth/login', [MainController::class, 'login'])->name('auth.login');
    Route::get('/auth/register', [MainController::class, 'register'])->name('auth.register');


    Route::get('/', [FormController::class, 'index'])->name('home');
});