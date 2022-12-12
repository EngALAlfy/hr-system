<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogViewerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRateController;
use App\Http\Controllers\UserWalletController;
use Illuminate\Support\Facades\Artisan;
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

// artisan commands
Route::get('/linkstorage', function () {
    return Artisan::call('storage:link');
});

Route::get('/login', [AuthController::class, 'showLogin'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::redirect("/" , "/home");

Route::middleware('auth')->group(function(){
    Route::get("/home" , [HomeController::class , 'home'])->name('home');

    // user wallet
    Route::get('/users/{user}/wallet' , [UserWalletController::class , 'index'])->name('users.wallet');
    Route::post('/users/{user}/wallet/store' , [UserWalletController::class , 'store'])->name('users.wallet.store');
    Route::delete('/users/wallet/{userWallet}' , [UserWalletController::class , 'destroy'])->name('users.wallet.destroy');
    // user rate
    Route::get('/users/{user}/ratings' , [UserRateController::class , 'index'])->name('users.ratings');
    Route::delete('/users/ratings/{userRate}' , [UserRateController::class , 'destroy'])->name('users.ratings.destroy');
    Route::get('/users/ratings/monthly' , [UserController::class , 'monthlyRatings'])->name('users.ratings-monthly');
    Route::post('/users/{user}/ratings/store' , [UserRateController::class , 'store'])->name('users.ratings.store');

    //user roles
    Route::get('/users/{user}/roles' , [RoleController::class , 'index'])->name('users.roles');

    Route::get('/users/attendance' , [AttendanceController::class , 'index'])->name('users.attendance');
    Route::post('/users/{user}/attendance/store' , [AttendanceController::class , 'store'])->name('users.attendance.store');
    Route::get('/users/projects' , [UserController::class , 'projects'])->name('users.projects');
    Route::post('/users/{user}/projects/store' , [UserController::class , 'changeProject'])->name('users.projects.store');

    // projects subs
    Route::get('/projects/{project}/users' , [AttendanceController::class , 'index'])->name('projects.users');
    Route::get('/projects/{project}/users/ratings' , [AttendanceController::class , 'index'])->name('projects.users.ratings');
    Route::get('/projects/{project}/users/addentance' , [AttendanceController::class , 'index'])->name('projects.users.attendance');

    Route::get('/projects/{project}/posts' , [AttendanceController::class , 'index'])->name('projects.posts');

    // branches subs
    Route::get('/branches/{branch}/users' , [AttendanceController::class , 'index'])->name('branches.users');
    Route::get('/branches/{branch}/users/ratings' , [AttendanceController::class , 'index'])->name('branches.users.ratings');
    Route::get('/branches/{branch}/users/addentance' , [AttendanceController::class , 'index'])->name('branches.users.attendance');

    Route::get('/branches/{branch}/posts' , [AttendanceController::class , 'index'])->name('branches.posts');


    Route::resource('/branches' , BranchController::class);
    Route::resource('/projects' , ProjectController::class);
    Route::resource('/posts' , PostController::class);
    Route::resource('/files' , FileController::class);
    Route::resource('/pages' , PageController::class);
    Route::resource('/users' , UserController::class);

    // error log viewer system
    Route::get('/error-viewer', [LogViewerController::class , 'getAllLogErrors'])->name('error-viewer.index');

    Route::get('/settings', [LogViewerController::class , 'getAllLogErrors'])->name('settings');
    Route::get('/account', [LogViewerController::class , 'getAllLogErrors'])->name('account');
    Route::get('/language', [LogViewerController::class , 'getAllLogErrors'])->name('language');

});
