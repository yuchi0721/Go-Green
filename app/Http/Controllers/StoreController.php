<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class StoreController extends Controller
{
    public function storeDetail($id){
        $store = \App\Models\greenstore::find($id);
        $user_logged_in= $isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
            $comments = \App\Models\Hotel_comments::where('hotel_id', $id)->get();
            return view('store.storeDetail',['store' => $store,'comments'=>$comments, 'user_logged_in' => $user_logged_in]);
        }
        return view('store.storeDetail',['store' => $store,'isAdmin' => $isAdmin,'user_logged_in' => $user_logged_in]);
    }

    public function storeOverview(){
        $user_logged_in= $isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }
        $stores = \App\Models\greenstore::get();
        return view('store.storeOverview',['stores' => $stores,'isAdmin' => $isAdmin,'user_logged_in' => $user_logged_in]);
    }
}
