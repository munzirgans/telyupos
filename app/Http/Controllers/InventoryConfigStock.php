<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfigStock;
use App\ConfigPpn;

class InventoryConfigStock extends Controller
{
    public function index(){
        $stock = ConfigStock::all();
        $ppn = ConfigPpn::all();
        return view('inventory/konfig/stock_min/index',["stock"=>$stock,"ppn"=>$ppn]);
    }
    public function add(){
        return view('inventory/konfig/stock_min/add');
    }
    public function store(Request $req){
        ConfigStock::create([
            "name" => $req->input('stock')
        ]);
        return redirect()->route('inventory.config.stock.index');
    }
    public function edit($id){
        $stock = ConfigStock::find($id);
        return view('inventory/konfig/stock_min/edit')->with('stock',$stock);
    }
    public function update(Request $req, $id){
        $stock = ConfigStock::find($id);
        $stock->name = $req->input('stock');
        $stock->save();
        return redirect()->route('inventory.config.stock.index');
    }
    public function delete($id){
        $stock = ConfigStock::find($id);
        $stock->delete();
        return redirect()->route('inventory.config.stock.index');
    }
}
