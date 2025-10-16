<?php

use App\Http\Controllers\backend\admin\master\TasksettingController;
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
Route::get('/clear', [AuthController::class, 'clearCache']);





Route::middleware(['prevent-back', 'prevent-back-history'])->group(function(){
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('admin.dashboard');
    Route::post('/lock-screen-status',[LockscreenController::class,'lockStatus'])->name('lockscreen-status');
    Route::get('/lock-screen-value',[LockscreenController::class,'checkLock'])->name('lockscreen-value');
    Route::post('/lock-screen-check',[LockscreenController::class,'checkLockpass'])->name('lockscreen-check');
    Route::post('/unlock', [LockscreenController::class, 'unlock'])->name('unlock');

    Route::get('/users',[UserController::class,'users'])->name('admin-master-users');
    Route::get('/task-setting',[TasksettingController::class,'taskSetting'])->name('admin-master-taskSetting');
    Route::post('/task-label-add',[TasksettingController::class,'taskLabelAdd'])->name('admin-master-taskLabel-add');
    Route::post('/task-label-view',[TasksettingController::class,'taskLabelView'])->name('admin-master-taskLabel-view');
    Route::post('/task-label-position',[TasksettingController::class,'taskLabelPositionUpdate'])->name('admin-master-taskLabel-positionUpdate');
    Route::post('/task-label-switch',[TasksettingController::class,'switch'])->name('admin-master-taskLabel-switch');
    Route::post('/task-label-details',[TasksettingController::class,'getDetails'])->name('admin-master-taskLabel-getDetails');
    Route::post('/task-label-update',[TasksettingController::class,'update'])->name('admin-master-taskLabel-update');
    Route::post('/task-label-delete',[TasksettingController::class,'delete'])->name('admin-master-taskLabel-delete');

    Route::post('/task-status-view',[TasksettingController::class,'taskStatusView'])->name('admin-master-taskStatus-view');
    Route::post('/task-status-add',[TasksettingController::class,'taskStatusAdd'])->name('admin-master-taskStatus-add');
    Route::post('/task-status-position',[TasksettingController::class,'taskStatusPositionUpdate'])->name('admin-master-taskSetting-positionUpdate');
    Route::post('/task-status-switch',[TasksettingController::class,'taskStatusSwitch'])->name('admin-master-taskSetting-switch');
    Route::post('/task-status-details',[TasksettingController::class,'taskStatusGetDetails'])->name('admin-master-taskSetting-getDetails');
    Route::post('/task-status-update',[TasksettingController::class,'taskStatusUpdate'])->name('admin-master-taskSetting-update');
    Route::post('/task-status-delete',[TasksettingController::class,'taskStatusDelete'])->name('admin-master-taskSetting-delete');

    Route::post('/task-priority-view',[TasksettingController::class,'taskPriorityView'])->name('admin-master-taskPriority-view');
    Route::post('/task-priority-add',[TasksettingController::class,'taskPriorityAdd'])->name('admin-master-taskPriority-add');
    Route::post('/task-priority-position',[TasksettingController::class,'taskPriorityPositionUpdate'])->name('admin-master-taskPriority-positionUpdate');
    Route::post('/task-priority-switch',[TasksettingController::class,'taskPrioritySwitch'])->name('admin-master-taskPriority-switch');
    Route::post('/task-priority-details',[TasksettingController::class,'taskPriorityGetDetails'])->name('admin-master-taskPriority-getDetails');
    Route::post('/task-priority-update',[TasksettingController::class,'taskPriorityUpdate'])->name('admin-master-taskPriority-update');
    Route::post('/task-priority-delete',[TasksettingController::class,'taskPriorityDelete'])->name('admin-master-taskPriority-delete');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
