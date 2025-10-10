<?php

use App\Http\Controllers\backend\auth\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('backend.admin.modules.dashboard');
// });

Route::get('/', [AuthController::class, 'index'])->name('index');
Route::post('login', [AuthController::class, 'authenticate'])->name('auth.login');
Route::get('/admin-forgetPassword', [AuthController::class, 'forgetpass'])->name('backend.forgetpass');
Route::post('send-magic-link', [AuthController::class, 'magiclink'])->name('auth.magiclink');
Route::get('/forgot-password', function () { return view('backend/auth/forgot-password'); });

Route::get('/dashboard',[AuthController::class,'dashboard'])->name('admin.dashboard');

Route::post('send-otp', [AuthController::class, 'sendOtp'])->name('auth.sendOtp');
Route::post('/admin-otpVerify', [AuthController::class, 'verifyotp'])->name('auth.verify_otp');
Route::post('/admin-passwordChange', [AuthController::class, 'updatepass'])->name('auth.update_pass');
Route::get('/m-l/{token}', [AuthController::class, 'magicLinkVerify']);
Route::get('/tokenInvalid', [AuthController::class, 'tokenError'])->name('auth.token_error');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');