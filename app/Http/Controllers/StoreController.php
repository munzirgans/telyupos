<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use File;

class StoreController extends Controller
{
    public function index(){
        $store = Store::first();
        return view('master/store/index',['store' => $store]);
    }
    public function edit(){
        $store = Store::first();
        return view('master/store/edit',['store' => $store]);
    }
    public function update(Request $req){
        $store = Store::first();
        if ($req->hasfile('photo')){
            $file_photo = $req->file('photo');
            File::delete('img/'.$store->photo);
            $file_photo->move("img",$file_photo->getClientOriginalName());
            $store->name = $req->input('name');
            $store->phone = $req->input('phone');
            $store->address = $req->input('address');
            $store->postal_code = $req->input('postal_code');
            $store->description = $req->input('description');
            $store->photo = $file_photo->getClientOriginalName();
            $store->save();
            return redirect()->route('store.index');
        } else{
            $store->name = $req->input('name');
            $store->phone = $req->input('phone');
            $store->address = $req->input('address');
            $store->postal_code = $req->input('postal_code');
            $store->description = $req->input('description');
            $store->save();
            return redirect()->route('store.index');
        }
    }
}
