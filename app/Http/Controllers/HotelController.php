<?php

namespace App\Http\Controllers;

use App\Models\greenHotel;
use App\Models\Hotel_comments;
use Illuminate\Http\Request;
use App\Models\User;

class HotelController extends Controller
{


    public function createHotel(Request $request)
    {
        // validate user input is correct
        $request->validate([
            'name' => 'required|max:30',
            'address' => 'required|max:80',
            'intro' => 'max:255',
            'phone' => 'max:20',
        ]);

        //new a User model and save into it
        $hotel = new \App\Models\greenHotel;
        $hotel->name = $request->name;
        $hotel->address = $request->address;
        if ($request->intro) {
            $hotel->intro = $request->intro;
        }else{
            $hotel->intro = '未提供';
        }
        if ($request->phone) {
            $hotel->phone = $request->phone;
        }else{
            $hotel->phone = '未提供';
        }
        $query = $hotel->save();

        //if save model successful, return success message,else return error
        if ($query) {
            return back()->with('success', 'You have been successfully create hotel !');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }

    public function deleteHotel($id)
    {
        $hotel = greenHotel::find($id);
        $hotel->delete();
        if ($hotel) {
            return back()->with('success', 'You have been successfuly delete hotel !');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }

    public function editHotel(Request $request, $id)
    {
        // validate user input is correct
        $request->validate([
            'name' => 'required|max:30',
            'address' => 'required|max:80',
            'intro' => 'max:255',
            'phone' => 'max:20',
        ]);

        //new a User model and save into it
        $hotel = greenHotel::where('id', $id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'intro' => $request->intro,
        ]);
        if ($request->intro) {
            $hotel->intro = $request->intro;
        }else{
            $hotel->intro = '未提供';
        }
        if ($request->phone) {
            $hotel->phone = $request->phone;
        }else{
            $hotel->phone = '未提供';
        }
        //if save model successful, return success message,else return error
        if ($hotel) {
            return back()->with('success', 'You have been successfuly update hotel !');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }

    public function showHotels()
    {
        $hotels = \App\Models\greenHotel::get();
        $user = $user_logged_in = $isAdmin  = false;
        if (session()->has('LoggedUser')) {
            $user_logged_in = true;
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
        }

        if ($isAdmin) {
            return view('hotel.hotels', ['user' => $user, 'hotels' => $hotels, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
        }

        return view('hotel.hotelOverview', ['user' => $user, 'hotels' => $hotels, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }

    public function hotelDetail($id)
    {
        $hotel = \App\Models\greenHotel::find($id);
        $user = $user_logged_in = $isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
            $comments = \App\Models\Hotel_comments::where('hotel_id', $id)->get();
            return view('hotel.hotelDetail', ['user' => $user, 'hotel' => $hotel, 'comments' => $comments, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
        }
        return view('hotel.hotelDetail', ['user' => $user, 'hotel' => $hotel, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }

    public function hotelOverview()
    {
        $user = $user_logged_in = $isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }
        $hotels = greenHotel::paginate(15);
        return view('hotel.hotelOverview', ['user' => $user, 'hotels' => $hotels, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }
    public function hotelAreaview()
    {
        $user = $user_logged_in = $isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }
        $hotels = \App\Models\greenHotel::get();
        return view('hotel.hotelAreaview', ['user' => $user, 'hotels' => $hotels, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }

    public function findHotel($area)
    {
        $q = $area;
        $user = $user_logged_in = $isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }

        $hotels = greenHotel::where('address', 'like', '%' . $q . '%')->paginate(15);
        return view('hotel.hotelOverview', ['user' => $user, 'hotels' => $hotels, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }

    public function createComment(Request $request)
    {
        $request->validate([
            'comment' => 'required|max:255'
        ]);
        $comment = new Hotel_comments;
        $comment->user_id = $request->user_id;
        $comment->hotel_id = $request->hotel_id;
        $comment->comment = $request->comment;
        $query = $comment->save();

        if ($query) {
            return back()->with('success', 'You have been successfuly create comment');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }

    public function deleteComment($id)
    {
        $comment = Hotel_comments::find($id);
        $comment->delete();
        if ($comment) {
            return back()->with('success', 'You have been successfuly delete comment');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }

    public function readHotel(Request $request)
    {
        $q = $request->name_query;
        $user = $user_logged_in = $isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }
        $hotels  = greenHotel::paginate(15);
        if (request('name_query')) {
            $hotels = greenHotel::where('name', 'like', '%' . $q . '%')->paginate(15);
        }

        return view('hotel.hotelOverview', ['user' => $user, 'hotels' => $hotels, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }
}
