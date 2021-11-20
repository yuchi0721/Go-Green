<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('signup');
    }

    public function createUser(Request $request){
        $data = $request->all();
        \App\Models\User::create($data);
        return view('user');
    }

    public function showUser(){
        $users = \App\Models\User::get();
        return view('users',['users' => $users]);
    }
}
