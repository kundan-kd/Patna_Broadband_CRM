<?php

use App\Http\Controllers\backend\admin\master\UserController;
use App\Http\Controllers\backend\auth\AuthController;
use App\Http\Controllers\backend\home\LockscreenController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('index');
Route::post('login', [AuthController::class, 'authenticate'])->name('auth.login');
Route::get('/admin-forgetPassword', [AuthController::class, 'forgetpass'])->name('backend.forgetpass');
Route::post('send-magic-link', [AuthController::class, 'magiclink'])->name('auth.magiclink');
Route::get('/forgot-password', function () { return view('backend/auth/forgot-password'); });
Route::post('send-otp', [AuthController::class, 'sendOtp'])->name('auth.sendOtp');
Route::post('/admin-otpVerify', [AuthController::class, 'verifyotp'])->name('auth.verify_otp');
Route::post('/admin-passwordChange', [AuthController::class, 'updatepass'])->name('auth.update_pass');
Route::get('/m-l/{token}', [AuthController::class, 'magicLinkVerify']);
Route::get('/tokenInvalid', [AuthController::class, 'tokenError'])->name('auth.token_error');



Route::post('/lock-screen-status',[LockscreenController::class,'lockStatus'])->name('lockscreen-status');
Route::get('/lock-screen-value',[LockscreenController::class,'checkLock'])->name('lockscreen-value');
Route::post('/lock-screen-check',[LockscreenController::class,'checkLockpass'])->name('lockscreen-check');
// Route::get('/lock-screen', function () {return view('backend.home.lockscreen');})->name('lockscreen');
Route::post('/unlock', [LockscreenController::class, 'unlock'])->name('unlock');

Route::middleware(['prevent-back'])->group(function(){
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('admin.dashboard');


    Route::get('/admin-users',[UserController::class,'users'])->name('admin-master-users');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
