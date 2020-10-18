<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfigProfit;

class InventoryConfigProfit extends Controller
{
    public function index(){
        $profit = ConfigProfit::all();
        return view('inventory/konfig/profit/index',["profit"=>$profit]);
    }
    public function edit($id){
        $profit = ConfigProfit::find($id);
        return view('inventory/konfig/profit/edit',["profit"=>$profit]);
    }
    public function add(){
        return view('inventory/konfig/profit/add');
    }
    public function store(Request $req){
        ConfigProfit::create([
            "name" => $req->input('profit')
        ]);
        return redirect()->route('inventory.config.profit.index');
    }
    public function update(Request $req, $id){
        $profit = ConfigProfit::find($id);
        $profit->name = $req->input('profit');
        $profit->save();
        return redirect()->route('inventory.config.profit.index');
    }
    public function delete($id){
        $profit = ConfigProfit::find($id);
        $profit->delete();
        return redirect()->route('inventory.config.profit.index');
    }
}
