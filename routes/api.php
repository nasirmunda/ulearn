<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/user/index', [App\Http\Controllers\UserController::class, 'index']);//->name('user.index');//->middleware('admin');

//Route::middleware('admin')->group( function () {
// Users
    Route::get('/admin/user/index', [App\Http\Controllers\admin\UserController::class, 'index']);
    Route::post('/admin/user/store', [App\Http\Controllers\admin\UserController::class, 'store']);
    Route::put('/admin/user/update/{id}', [App\Http\Controllers\admin\UserController::class, 'update']);
    Route::delete('/admin/user/destroy/{id}', [App\Http\Controllers\admin\UserController::class, 'destroy']);
//});
// Courses 
Route::get('/course/index', [App\Http\Controllers\CourseController::class, 'index']);