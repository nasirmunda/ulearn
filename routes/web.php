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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//Admin
Route::get('admin/dashboard', [App\Http\Controllers\HomeController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('admin');
Route::get('/admin/student', function () {
    return view('/admin/student');
});

//Route::get('/admin/student', [App\Http\Controllers\admin\UserController::class, 'index'])->name('admin.user.store')->middleware('admin');
//Route::get('admin/profile', [App\Http\Controllers\HomeController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('admin');


Route::get('educator/dashboard', [App\Http\Controllers\HomeController::class, 'educatorDashboard'])->name('educator.dashboard')->middleware('educator');
Route::get('student/dashboard', [App\Http\Controllers\HomeController::class, 'studentDashboard'])->name('student.dashboard')->middleware('student');
//Route::get('admin/home', 'HomeController@handleAdmin')->name('admin.route')->middleware('admin');
