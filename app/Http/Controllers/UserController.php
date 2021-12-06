<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session ;

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


    public function createUser(Request $request)
    {
        // validate user input is correct
        $request->validate([
            'name' => 'required',
            'account' => 'required|unique:users,account',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:12',
            'passwordcheck' => 'required|min:8|max:12',
        ]);

        //check password = password-checked
        if ($request->passwordcheck!=$request->password){
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

    public function showUser()
    {
        $users = \App\Models\User::get();
        $user_logged_in = false;
        if (session()->has('LoggedUser')) {
            $user_logged_in = true;
        }
        return view('users', ['users' => $users,'user_logged_in'=>$user_logged_in]);
    }

    public function check(Request $request)
    {
        $request->validate([
            'account' => 'required',
            'password' => 'required|min:8|max:12',
            //google reCAPTCHA mechansim => call api with parameters(secretKey,response,remoteip)
            'g-recaptcha-response' => function($attribute, $value, $fail){
                $secretKey = config('services.recaptcha.secret');
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                $response = \file_get_contents($url);
                $response = json_decode($response);
                if(!$response->success){
                    Session::flash('g-recaptcha-response','please check reCaptcha');
                    Session::flash('alert-class','alert-danger');
                    $fail($attribute.'google reCaptcha failed');
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
