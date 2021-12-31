<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function about()
    {
        $user = $user_logged_in = $isAdmin = false;

        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }
        return view('about', ['user' => $user, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }
}
