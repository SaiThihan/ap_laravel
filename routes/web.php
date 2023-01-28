<?php

use App\Test;
use App\Container;
use App\TestFacade;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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

// Route::get('/',function(){
//     dd(resolve('test')->execute());
// } );

Route::resource('posts', HomeController::class);

Route::get('logout', [AuthController::class,'logout']);






/* 
    get -> all posts
    get -> create form
    post -> store function / method
    get -> show function
    get -> edit forms
    put -> all params update / patch -> single param update
    delete -> post delete

    Route::get('post');
    Route::post('post'); //Store method
    Route::get('post/{id}');
    Route::get('post/{id}/edit');
    Route::put('post/{id}'); // will run update method
    Route::delete('post/{id}'); // will run delete method
*/








Route::middleware(['auth:sanctum', 'verified'])->get('/posts', [HomeController::class,'index']);
