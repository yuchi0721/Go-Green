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
            'name' => 'required|max:30',
            'address' => 'required|max:80',
            'intro'=>'max:255',
            'phone' =>'max:20',
        ]);

        //new a User model and save into it
        $store = new greenStore;
        $store->name = $request->name;
        $store->address = $request->address;
        if ($request->intro) {
            $store->intro = $request->intro;
        }else{
            $store->intro = '未提供';
        }
        if ($request->phone) {
            $store->phone = $request->phone;
        }else{
            $store->phone = '未提供';
        }
        $query = $store->save();

        //if save model successful, return success message,else return error
        if ($query) {
            return back()->with('success', 'You have been successfully create store !');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }

    public function deleteStore($id)
    {
        $store = greenStore::find($id);
        $store->delete();
        if ($store) {
            return back()->with('success', 'You have been successfully delete store !');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }

    public function editStore(Request $request, $id)
    {
        // validate user input is correct
        $request->validate([
            'name' => 'required|max:30',
            'address' => 'required|max:80',
            'intro'=>'max:255',
            'phone' =>'max:20',
        ]);

        //new a User model and save into it
        $store = greenStore::where('id', $id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'intro' => $request->intro,
        ]);
        if ($request->intro) {
            $store->intro = $request->intro;
        }else{
            $store->intro = '未提供';
        }
        if ($request->phone) {
            $store->phone = $request->phone;
        }else{
            $store->phone = '未提供';
        }
        //if save model successful, return success message,else return error
        if ($store) {
            return back()->with('success', 'You have been successfully update store');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }

    public function showStores()
    {
        $stores = greenStore::get();
        $user = $user_logged_in = $isAdmin  = false;
        if (session()->has('LoggedUser')) {
            $user_logged_in = true;
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
        }

        if ($isAdmin) {
            return view('store.stores', ['user'=>$user ,'stores' => $stores, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
        }

        return view('store.storeOverview', ['user'=>$user,'stores' => $stores, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }
    public function storeDetail($id)
    {
        $store = greenStore::find($id);
        $user = $user_logged_in = $isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
            $comments = \App\Models\store_comments::where('store_id', $id)->get();
            return view('store.storeDetail', ['user' => $user, 'store' => $store, 'comments' => $comments, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
        }
        return view('store.storeDetail', ['user'=>$user,'store' => $store, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }


    public function storeOverview()
    {
        $user = $user_logged_in = $isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }
        $stores = greenstore::paginate(15);
        return view('store.storeOverview', ['user'=>$user,'stores' => $stores, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }

    public function storeAreaview()
    {   
        $user =  $user_logged_in=$isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }
        $stores = \App\Models\greenstore::get();
        return view('store.storeAreaview', ['user'=>$user,'stores' => $stores,'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }

    public function findStore($area){
        $q = $area;
        $user = $user_logged_in=$isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }
        
        $stores = greenstore::where('address','like','%'.$q.'%')->paginate(15);
        return view('store.storeOverview', ['user'=>$user,'stores' => $stores,'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }

    public function createComment(Request $request)
    {
        $request->validate([
            'comment' => 'required|max:255'
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

    public function deleteComment($id)
    {
        $comment = Store_comments::find($id);
        $comment->delete();
        if ($comment) {
            return back()->with('success', 'You have been successfuly delete comment');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }

    public function readStore(Request $request)
    {
        $q = $request->name_query;
        $user = $user_logged_in = $isAdmin = false;
        if (session()->has('LoggedUser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            $isAdmin = $user->admin;
            $user_logged_in = true;
        }
        $stores = greenStore::paginate(15);
        if (request('name_query')) {
            $stores = greenStore::where('name', 'like', '%' . $q . '%')->paginate(15);
        }
        return view('store.storeOverview', ['user'=>$user,'stores' => $stores, 'isAdmin' => $isAdmin, 'user_logged_in' => $user_logged_in]);
    }
}
