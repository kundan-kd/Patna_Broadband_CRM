<?php

namespace App\Http\Controllers\backend\admin\master;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users(){
        $users = User::where('status',1)->get();
        return view('backend.admin.modules.master.user',compact('users'));
    }
}
