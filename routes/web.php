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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/update-list-user', [App\Http\Controllers\HomeController::class, 'updateUserList']);
Route::post('/create-update-user', [App\Http\Controllers\HomeController::class, 'storeUser']);
Route::post('/delete', [App\Http\Controllers\HomeController::class, 'deleteUser']);

Route::get('/update-list-role', [App\Http\Controllers\HomeController::class, 'updateRoleList']);
Route::post('/create-update-role', [App\Http\Controllers\HomeController::class, 'storeRole']);
Route::post('/delete-role', [App\Http\Controllers\HomeController::class, 'deleteRole']);

