<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfigCurrency;

class InventoryConfigCurrency extends Controller
{
    public function index(){
        $curr = ConfigCurrency::all();
        return view("inventory/konfig/currency/index",["curr" => $curr]);
    }
    public function add(){
        return view('inventory/konfig/currency/add');
    }
    public function store(Request $req){
        ConfigCurrency::create([
            "name" => $req->input('currency')
        ]);
        return redirect()->route('inventory.config.currency.index');
    }
    public function edit($id){
        $curr = ConfigCurrency::find($id);
        return view("inventory/konfig/currency/edit", ['currency' => $curr]);
    }
    public function update(Request $req, $id){
        $curr = ConfigCurrency::find($id);
        $curr->name = $req->input('currency');
        $curr->save();
        return redirect()->route('inventory.config.currency.index');
    }
    public function delete($id){
        $curr = ConfigCurrency::find($id);
        $curr->delete();
        return redirect()->route("inventory.config.currency.index");
    }
    // public function edit($Request $req, $id){
    //     $curr = ConfigCurrency::find($id);
    //     $curr->name = $req->input('')
    // }
}
