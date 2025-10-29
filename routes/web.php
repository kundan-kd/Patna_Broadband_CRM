<?php

use App\Http\Controllers\backend\admin\master\CustomfieldController;
use App\Http\Controllers\backend\admin\master\TaskController;
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
    Route::post('/task-label/undo-position', [TasksettingController::class, 'undoTaskLabelPosition'])->name('undoTaskLabelPosition');


    Route::post('/custom-field-category-view',[TasksettingController::class,'taskCategoryView'])->name('admin-master-taskCategory-view');
    Route::post('/custom-field-category-add',[TasksettingController::class,'taskCategoryAdd'])->name('admin-master-taskCategory-add');
    Route::post('/custom-field-category-position',[TasksettingController::class,'taskCategoryPositionUpdate'])->name('admin-master-taskCategory-positionUpdate');
    Route::post('/custom-field-category-switch',[TasksettingController::class,'taskCategorySwitch'])->name('admin-master-taskCategory-switch');
    Route::post('/custom-field-category-details',[TasksettingController::class,'taskCategoryGetDetails'])->name('admin-master-taskCategory-getDetails');
    Route::post('/custom-field-category-update',[TasksettingController::class,'taskCategoryUpdate'])->name('admin-master-taskCategory-update');
    Route::post('/custom-field-category-delete',[TasksettingController::class,'taskCategoryDelete'])->name('admin-master-taskCategory-delete');
    Route::post('/custom-field-category/undo-position', [TasksettingController::class, 'undoTaskCategoryPosition'])->name('undoTaskCategoryPosition');

    Route::post('/task-status-view',[TasksettingController::class,'taskStatusView'])->name('admin-master-taskStatus-view');
    Route::post('/task-status-add',[TasksettingController::class,'taskStatusAdd'])->name('admin-master-taskStatus-add');
    Route::post('/task-status-position',[TasksettingController::class,'taskStatusPositionUpdate'])->name('admin-master-taskSetting-positionUpdate');
    Route::post('/task-status-switch',[TasksettingController::class,'taskStatusSwitch'])->name('admin-master-taskSetting-switch');
    Route::post('/task-status-details',[TasksettingController::class,'taskStatusGetDetails'])->name('admin-master-taskSetting-getDetails');
    Route::post('/task-status-update',[TasksettingController::class,'taskStatusUpdate'])->name('admin-master-taskSetting-update');
    Route::post('/task-status-delete',[TasksettingController::class,'taskStatusDelete'])->name('admin-master-taskSetting-delete');
    Route::post('/task-status/undo-position', [TasksettingController::class, 'undoTaskStatusPosition'])->name('undoTaskStatusPosition');

    Route::post('/task-priority-view',[TasksettingController::class,'taskPriorityView'])->name('admin-master-taskPriority-view');
    Route::post('/task-priority-add',[TasksettingController::class,'taskPriorityAdd'])->name('admin-master-taskPriority-add');
    Route::post('/task-priority-position',[TasksettingController::class,'taskPriorityPositionUpdate'])->name('admin-master-taskPriority-positionUpdate');
    Route::post('/task-priority-switch',[TasksettingController::class,'taskPrioritySwitch'])->name('admin-master-taskPriority-switch');
    Route::post('/task-priority-details',[TasksettingController::class,'taskPriorityGetDetails'])->name('admin-master-taskPriority-getDetails');
    Route::post('/task-priority-update',[TasksettingController::class,'taskPriorityUpdate'])->name('admin-master-taskPriority-update');
    Route::post('/task-priority-delete',[TasksettingController::class,'taskPriorityDelete'])->name('admin-master-taskPriority-delete');
    Route::post('/task-priority/undo-position', [TasksettingController::class, 'undoTaskPriorityPosition'])->name('undoTaskPriorityPosition');

    Route::get('/custom-field', [CustomfieldController::class, 'index'])->name('admin-master-customField.index');
    Route::post('/custom-field/store', [CustomFieldController::class, 'store'])->name('admin-master-customField.store');
    Route::post('/custom-field/view', [CustomFieldController::class, 'view'])->name('admin-master-customField.view');
    Route::post('/custom-field/positionUpdate', [CustomFieldController::class, 'positionUpdate'])->name('admin-master-customField.positionUpdate');
    Route::post('/custom-field/undoPosition', [CustomFieldController::class, 'undoPosition'])->name('admin-master-customField.undoPosition');
    Route::post('/custom-field/switch', [CustomFieldController::class, 'switch'])->name('admin-master-customField.switch');
    Route::post('/custom-field/get-details', [CustomFieldController::class, 'getDetails'])->name('admin-master-customField.getDetails');
    Route::post('/custom-field/get-update', [CustomFieldController::class, 'update'])->name('admin-master-customField.update');
    Route::post('/custom-field/get-delete', [CustomFieldController::class, 'delete'])->name('admin-master-customField.delete');

    Route::get('/task', [TaskController::class, 'index'])->name('admin-master-task.index');
    Route::post('/task-add', [TaskController::class, 'add'])->name('admin-master-task.add');




    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
