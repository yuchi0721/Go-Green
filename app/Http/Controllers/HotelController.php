<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function hotelDetail($id){
        $hotel = \App\Models\greenHotel::find($id);
        $comments = \App\Models\Hotel_comments::where('hotel_id',$id)->get();
        return view('hotelDetail',['hotel' => $hotel,'comments'=>$comments]);
    }

    public function hotelOverview(){
        $hotels = \App\Models\greenHotel::get();
        return view('hotelOverview',['hotels' => $hotels]);
    }
}
