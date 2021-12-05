<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function hotelDetail($id)
    {
        $hotel = \App\Models\greenHotel::find($id);
        $user_logged_in = false;
        if (session()->has('LoggedUser')) {
            $user_logged_in = true;
            $comments = \App\Models\Hotel_comments::where('hotel_id', $id)->get();
            return view('hotelDetail', ['hotel' => $hotel, 'comments' => $comments, 'user_logged_in' => $user_logged_in]);
        }
        return view('hotelDetail', ['hotel' => $hotel, 'user_logged_in' => $user_logged_in]);
    }

    public function hotelOverview()
    {   
        $user_logged_in = false;
        if (session()->has('LoggedUser')) {
            $user_logged_in = true;
        }
        $hotels = \App\Models\greenHotel::get();
        return view('hotelOverview', ['hotels' => $hotels, 'user_logged_in' => $user_logged_in]);
    }
}
