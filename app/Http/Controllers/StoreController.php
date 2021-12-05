<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function storeDetail($id){
        $store = \App\Models\greenstore::find($id);
        $user_logged_in = false;
        if (session()->has('LoggedUser')) {
            $user_logged_in = true;
            $comments = \App\Models\Hotel_comments::where('hotel_id', $id)->get();
            return view('storeDetail',['store' => $store,'comments'=>$comments, 'user_logged_in' => $user_logged_in]);
        }
        return view('storeDetail',['store' => $store,'user_logged_in' => $user_logged_in]);
    }

    public function storeOverview(){
        $user_logged_in = false;
        if (session()->has('LoggedUser')) {
            $user_logged_in = true;
        }
        $stores = \App\Models\greenstore::get();
        return view('storeOverview',['stores' => $stores,'user_logged_in' => $user_logged_in]);
    }
}
