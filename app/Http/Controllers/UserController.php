<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function signup()
    {
        $user_logged_in = $isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }
        return view('auth.signup', ['isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }

    public function login()
    {
        $user_logged_in = $isAdmin  = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }
        return view('auth.login', ['isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }


    public function createUser(Request $request)
    {
        // validate user input is correct
        $request->validate([
            'name' => 'required|max:10',
            'account' => ['required','unique:users,account','max:12','regex:/^([a-zA-Z0-9!@#$%&_]+)$/'],
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:8|max:12',
            'passwordcheck' => 'required|min:8|max:12',
        ]);

        //check password = password-checked
        if ($request->passwordcheck != $request->password) {
            return back()->with('fail', 'Password check error');
        }

        //new a User model and save into it
        $user = new User;
        $user->name = $request->name;
        $user->account = $request->account;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $query = $user->save();

        //if save model successful, return success message,else return error
        if ($query) {
            return back()->with('success', 'You have been successfuly registered');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }
    
    public function updateUser(Request $request)
    {
        // validate user input is correct
        $user = User::where('id', '=', session('LoggedUser'))->first();
        $request->validate([
            'name' => 'required|max:10',
            'email' =>  ['required', 'email', \Illuminate\Validation\Rule::unique('users')->ignore($user->id),'max:255'],
        ]);


        //update a User

        $user = User::where('account', '=', $user->account)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);


        //if update model successful, return success message,else return error
        if ($user) {
            return back()->with('success', 'You have been successfuly update');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }
    public function adminUpdateUser(Request $request,$id)
    {
        // validate user input is correct
        $request->validate([
            'name' => 'required',
            'email' =>  ['required', 'email', \Illuminate\Validation\Rule::unique('users')->ignore($id),'max:255'],
        ]);


        //update a User

        $user = User::where('id', '=', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);


        //if update model successful, return success message,else return error
        if ($user) {
            return back()->with('success', 'You have been successfuly update');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }

    public function resetPassword()
    {
        if (session()->has('LoggedUser')) {

            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }
        return view('admin.resetPassword', ['user' => $user, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }

    public function resetUserPassword(Request $request)
    {
        // validate user input is correct
        $user = User::where('id', '=', session('LoggedUser'))->first();
        $request->validate([
            'password' => 'required|min:8|max:12|regex:/^([a-zA-Z0-9!@#$%&_]+)$/',
            'passwordcheck' => 'required|min:8|max:12|regex:/^([a-zA-Z0-9!@#$%&_]+)$/',
        ]);

        //check password = password-checked
        if ($request->passwordcheck != $request->password) {
            return back()->with('fail', 'Password check error');
        }
        //reset User password
        $user = User::where('account', $user->account)->update([
            'password' => Hash::make($request->password),
        ]);
        //if reset User password successful, return success message,else return error
        if ($user) {
            return back()->with('success', 'You have been successfuly reset');
        } else {
            return back()->with('fail', 'reset error');
        }
    }

    public function showUser()
    {
        $users = \App\Models\User::get();
        $user_logged_in = $isAdmin  = false;
        if (session()->has('LoggedUser')) {
            $user_logged_in = true;
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
        }
        if ($isAdmin) {
            return view('admin.users', ['users' => $users, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
        }
        return view('admin.profile', ['user' => $user, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }

    public function check(Request $request)
    {
        $request->validate([
            'account' => 'required|regex:/^([a-zA-Z0-9!@#$%&_]+)$/',
            'password' => 'required|min:8|max:12|regex:/^([a-zA-Z0-9!@#$%&_]+)$/',
            //google reCAPTCHA mechansim => call api with parameters(secretKey,response,remoteip)
            'g-recaptcha-response' => function ($attribute, $value, $fail) {
                $secretKey = config('services.recaptcha.secret');
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                $response = \file_get_contents($url);
                $response = json_decode($response);
                if (!$response->success) {
                    Session::flash('g-recaptcha-response', 'please check reCaptcha');
                    Session::flash('alert-class', 'alert-danger');
                    $fail($attribute . 'google reCaptcha failed');
                }
            },
        ]);

        $user = User::where('account', '=', $request->account)->first();

        if ($user) {
            //check password is correct
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
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }

        return view('admin.profile', ['user' => $user, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }

    public function logout()
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return back();
        }
    }
}
