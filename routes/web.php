<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\loginAdminController;
use App\Http\Controllers\auth\loginUserController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\FaculityController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserHomeController;
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

// Route::prefix('admin/')->group(function(){
//     Route::get('login',[loginAdminController::class , 'showLoginView'])->name('admin.login');
//     Route::post('login',[loginAdminController::class, 'login']);

// });

// Route::prefix('edu/user/')->group(function(){
    // Route::get('edit-password', [loginUserController::class, 'editPassword'])->name('password.u_edit');
    // Route::put('update-password', [loginUserController::class, 'updatePassword']);
    
    // Route::get('logout' , [loginUserController::class , 'logout'])->name('user.logout');
// });

// Route::get('/user/home', function () {
//     return view('s_library.user.home');
// })->middleware('auth:user')->name('user.home');

// Route::get('/admin/home', function () {
//     return view('s_library.admin.adminHome');
// })->middleware('auth:admin');



// *********************************


Route::prefix('edu/')->middleware('guest:user,admin')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLoginView'])->name('edu.login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('forgot-password', [ResetPasswordController::class, 'showForgotPassword'])->name('password.forgot');
    Route::post('forgot-password', [ResetPasswordController::class, 'sendResetEmail'])->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordView'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');

});

//Register User
Route::prefix('edu/')->middleware('guest:user')->group(function () {
    Route::get('register', [AuthController::class, 'showRegisterView'])->name('edu.register');

    // Route::get('users/create',[UserController::class,'create'])->name('user.create');
    Route::post('users',[UserController::class,'store'])->name('user.store');//register
});

// verified:
Route::prefix('edu')->middleware(['auth:admin,user'])->group(function () {
    Route::get('verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
    Route::get('send-verification', [EmailVerificationController::class, 'send'])->middleware('throttle:3,1')->name('verification.send');
    Route::get('verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
});

Route::prefix('edu')->middleware(['auth:admin,user', 'verified'])->group(function () {
    Route::get('edit-password', [AuthController::class, 'editPassword'])->name('password.edit');
    Route::put('update-password', [AuthController::class, 'updatePassword']);
});

//Admin & User
Route::prefix('edu/admin')->middleware(['auth:admin,user' , 'verified'])->group(function(){
    Route::resource('universities',UniversityController::class);
    Route::resource('faculities',FaculityController::class);
    Route::resource('departments',DepartmentController::class);

    Route::get('logout' , [AuthController::class , 'logout'])->name('edu.logout');
});

//admin
Route::prefix('edu/admin')->middleware(['auth:admin' , 'verified'])->group(function(){
    Route::get('dashboard',[DashboardController::class,'index'])->name('eduAdmin.dashboard');

    Route::resource('admins',AdminController::class);

    Route::get('users',[UserController::class,'index'])->name('user.index');
    Route::delete('/users/{user}',[UserController::class,'destroy'])->name('delete_user');

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::get('roles/{role}/permissions/edit', [RoleController::class, 'editRolePermissions'])->name('roles.edit-permissions');
    Route::put('roles/{role}/permissions/edit', [RoleController::class, 'updateRolePermissions']);

    Route::get('users/{user}/permissions/edit', [UserController::class, 'editUserPermissions'])->name('user.edit-permissions');
    Route::put('users/{user}/permissions/edit', [UserController::class, 'updateUserPermissions']);
});

//user
Route::prefix('edu/admin/')->middleware(['auth:user', 'verified'])->group(function(){
    Route::resource('/userHome',UserHomeController::class);

    Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('user.edit'); //edit_update User Profile
    Route::put('users/{user}',[UserController::class,'update'])->name('user.update');

    Route::resource('slides',SlideController::class);
});
