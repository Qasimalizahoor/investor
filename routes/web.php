<?php

use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Permission\PermissionController;


// use App\Http\Controllers\Mail\MailController;

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
    // return View::make('welcome');
    return view('Admin.SignIn.sign-in');
})->name('login-form');

Route::post('login',[SignInController::class,'login'])->name('login');
Route::get('logout',[SignInController::class,'logout'])->name('logout');



Route::middleware('auth.user')->group(function () {

    // Dashboard Routes
    Route::get('/admin/dashboard', [DashboardController::class,'admin'])->name('admin.dashboard');
    Route::get('/user/dashboard', [DashboardController::class,'user'])->name('user.dashboard');
    Route::get('/support/dashboard', [DashboardController::class,'support'])->name('support.dashboard');

    // Permission Routes

    Route::get('ajax/permission',[PermissionController::class,'getPermission'])->name('ajax.permission');
    Route::resource('permission',PermissionController::class);

    // Roles

    Route::get('roles',[RoleController::class,'index'])->name('roles');
    Route::get('assign/permission',[RoleController::class,'assignPermission'])->name('assign.permission');
    Route::post('assign/permission-to-role',[RoleController::class,'syncPermissionToRole'])->name('assing.permission-to-role');


    



    // Route::get('ajax/investor',[InvestorController::class,'getInvestor'])->name('ajax.investor');
    // Route::resource('investor',InvestorController::class)->name('admin.dashboard');
    // Route::resource('investor',InvestorController::class)->name('user.dashboard');
    // Route::resource('investor',InvestorController::class)->name('support.dashboard');
    

Route::get('ajax/investor',[InvestorController::class,'getInvestor'])->name('ajax.investor');
Route::resource('investor',InvestorController::class);

// Mails 
// Route::get('send-mail',[MailController::class,'mail']);
});
