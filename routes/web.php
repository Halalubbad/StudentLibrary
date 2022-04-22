<?php

use App\Http\Controllers\auth\loginAdminController;
use App\Http\Controllers\auth\loginUserController;
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

Route::get('/user/home', function () {
    return view('s_library.home');
})->middleware('auth:user');

Route::get('/admin/home', function () {
    return view('s_library.admin.adminHome');
})->middleware('auth:admin');

Route::prefix('admin/')->middleware('guest:admin')->group(function(){
    Route::get('login',[loginAdminController::class , 'showLoginView'])->name('admin.login');
    Route::post('login',[loginAdminController::class, 'login']);
});

Route::prefix('edu/user')->middleware('guest:user')->group(function(){
    Route::get('login',[loginUserController::class , 'showLoginView'])->name('user.login');
    Route::post('login',[loginUserController::class, 'login']);
});

Route::prefix('edu/user')->middleware('auth:user')->group(function(){
    Route::get('logout' , [loginUserController::class , 'logout'])->name('user.logout');
});

Route::prefix('admin/')->middleware('auth:admin')->group(function(){
    Route::get('logout' , [loginAdminController::class , 'logout'])->name('admin.logout');
});
