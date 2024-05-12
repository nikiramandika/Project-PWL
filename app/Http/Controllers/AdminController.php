<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view_user(){
        $users = User::all();
        return view('admin.users.user-management',compact(['users']));
    }

}
