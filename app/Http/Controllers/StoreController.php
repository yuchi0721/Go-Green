<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\greenStore;
use App\Models\Store_comments;
class StoreController extends Controller
{
    public function createStore(Request $request)
    {
        // validate user input is correct
        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        //new a User model and save into it
        $store = new greenStore;
        $store->name = $request->name;
        $store->intro = $request->intro;
        $store->address = $request->address;
        $store->phone = $request->phone;
        $query = $store->save();

        //if save model successful, return success message,else return error
        if ($query) {
            return back()->with('success', 'You have been successfuly create store');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }
    
    public function deleteStore($id){
        $store = greenStore::find($id); 
        $store->delete();
        if ($store) {
            return back()->with('success', 'You have been successfuly create store');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }

    public function editStore(Request $request,$id)
    {
        // validate user input is correct
        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        //new a User model and save into it
        $store = greenStore::where('id',$id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'intro' => $request->intro,
        ]);

        //if save model successful, return success message,else return error
        if ($store) {
            return back()->with('success', 'You have been successfuly create store');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }

    public function showStores(){
        $stores = greenStore::get();
        $user_logged_in = $isAdmin  = false;
        if (session()->has('LoggedUser')) {
            $user_logged_in = true;
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
        }

        if ($isAdmin) {
            return view('store.stores', ['stores' => $stores, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
        }

        return view('store.storeOverview', ['stores' => $stores,'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);

    }
    public function storeDetail($id){
        $store = greenStore::find($id);
        $user_logged_in= $isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
            $comments = \App\Models\store_comments::where('store_id', $id)->get();
            return view('store.storeDetail',[ 'user'=>$user,'store' => $store,'comments'=>$comments,'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
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

    public function createComment(Request $request){
        $request->validate([
            'comment'=>'required'
        ]);
        $comment = new Store_comments;
        $comment->user_id = $request->user_id;
        $comment->store_id = $request->store_id;
        $comment->comment = $request->comment;
        $query = $comment->save();

        if ($query) {
            return back()->with('success', 'You have been successfuly create comment');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }

    public function deleteComment($id){
        $comment = Store_comments::find($id);
        $comment->delete();
        if ($comment) {
            return back()->with('success', 'You have been successfuly delete comment');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }
}
