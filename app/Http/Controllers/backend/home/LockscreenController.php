<?php

namespace App\Http\Controllers\backend\home;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class LockscreenController extends Controller
{

    public function lockStatus(){
        $cookie = cookie(
            'lockscreen_status', // name
            'active',            // value
            1440,                   // duration in minutes
            null,                // path
            null,                // domain
            false,               // secure (true if using HTTPS)
            false,               // httpOnly (must be false for JS access)
            true                 // raw (true disables encryption)
        );
        Cookie::queue($cookie);
        return response()->json([
            'success' => 'lock success',
            'status' => 'active' // hardcoded since it's just been queued
        ], 200);

    }
    public function checkLock(Request $request)
    {
        $status = $request->cookie('lockscreen_status');
        return response()->json(['status' => $status]);
    }
    public function unlock(Request $request){
        $user = Auth::user();
        if (Hash::check($request->password, $user->password)) {
            return redirect()->intended('/'); // Redirect to home or previous page
        }
        return back()->withErrors(['password' => 'Incorrect password']);
    }

    public function checkLockpass(Request $request){
       $user_lock_pass = User::where('id', Auth::id())->value('lock_password'); // use value() instead of pluck()

    if ($request->password === $user_lock_pass) {
        Cookie::queue(Cookie::forget('lockscreen_status'));
        return response()->json(['status' => true]);
    } else {
        return response()->json(['status' => false]);
    }

    }

}
