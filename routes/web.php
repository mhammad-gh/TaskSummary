<?php

use Illuminate\Support\Facades\Auth;
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




Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\DashBoard\HomePageController::class, 'index'])->name('home')->middleware('verified');


Route::get('/tasks', [App\Http\Controllers\DashBoard\TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [App\Http\Controllers\DashBoard\TaskController::class, 'store'])->name('tasks.store');
Route::post('/actions', [App\Http\Controllers\DashBoard\ActionController::class, 'store'])->name('actions.store');

Route::post('/actions', [App\Http\Controllers\DashBoard\ActionController::class, 'newc'])->name('actions.store');
