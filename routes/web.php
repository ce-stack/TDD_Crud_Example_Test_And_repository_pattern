<?php

use App\Http\Controllers\PostController;
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

Route::get('posts.index' , [PostController::class , 'index']);
Route::get('posts.show/{id}' , [PostController::class , 'show']);
Route::get('posts.create' , [PostController::class , 'store'])->middleware('auth');
Route::put('posts/{id}' , [PostController::class , 'update']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
