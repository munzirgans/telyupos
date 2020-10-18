<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfigPpn;

class InventoryConfigPPN extends Controller
{
    public function add(){
        return view('inventory/konfig/stock_min/ppn/add');
    }
    public function store(Request $req){
        ConfigPpn::create([
            "name" => $req->input('ppn')
        ]);
        return redirect()->route("inventory.config.stock.index");
    }
    public function edit($id){
        $ppn = ConfigPpn::find($id);
        return view('inventory/konfig/stock_min/ppn/edit')->with("ppn",$ppn);
    }
    public function update(Request $req, $id){
        $ppn = ConfigPpn::find($id);
        $ppn->name = $req->input('ppn');
        $ppn->save();
        return redirect()->route('inventory.config.stock.index');
    }
    public function delete($id){
        $ppn = ConfigPpn::find($id);
        $ppn->delete();
        return redirect()->route('inventory.config.stock.index');
    }
}
