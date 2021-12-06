<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class HotelController extends Controller
{
    public function about(){
        $user_logged_in=$isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }
        return view('about', ['isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }
    
    public function hotelDetail($id)
    {
        $hotel = \App\Models\greenHotel::find($id);
        $user_logged_in=$isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
            $comments = \App\Models\Hotel_comments::where('hotel_id', $id)->get();
            return view('hotel.hotelDetail', ['hotel' => $hotel, 'comments' => $comments, 'user_logged_in' => $user_logged_in]);
        }
        return view('hotel.hotelDetail', ['hotel' => $hotel,'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }

    public function hotelOverview()
    {   
        $user_logged_in=$isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }
        $hotels = \App\Models\greenHotel::get();
        return view('hotel.hotelOverview', ['hotels' => $hotels,'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }
    public function hotelAreaview()
    {   
        $user_logged_in=$isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }
        $hotels = \App\Models\greenHotel::get();
        return view('hotel.hotelAreaview', ['hotels' => $hotels,'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }
}
