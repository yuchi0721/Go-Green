<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signup()
    {
        $user_logged_in = false;
        if (session()->has('LoggedUser')) {
            $user_logged_in = true;
        }
        return view('auth.signup', ['user_logged_in' => $user_logged_in]);
    }

    public function login()
    {
        $user_logged_in = false;
        if (session()->has('LoggedUser')) {
            $user_logged_in = true;
        }
        return view('auth.login', ['user_logged_in' => $user_logged_in]);
    }


    // public function createUser(Request $request){
    //     $data = $request->all();
    //     \App\Models\User::create($data);
    //     return view('user');
    // }
    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'account' => 'required|unique:users,account',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:12',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->account = $request->account;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $query = $user->save();

        if ($query) {
            return back()->with('success', 'You have been successfuly registered');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }

    public function showUser()
    {
        $users = \App\Models\User::get();
        return view('users', ['users' => $users]);
    }

    public function check(Request $request)
    {
        $request->validate([
            'account' => 'required',
            'password' => 'required|min:8|max:12',
        ]);

        $user = User::where('account', '=', $request->account)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('LoggedUser', $user->id);
                return redirect('profile');
            } else {
                return back()->with('fail', 'Invalid password');
            }
        } else {
            return back()->with('fail', 'Invalid account');
        }
    }

    public function profile()
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $user_logged_in = true;
        }

        return view('admin.profile', ['user' => $user, 'user_logged_in' => $user_logged_in]);
    }

    public function logout()
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return back();
        }
    }
}
