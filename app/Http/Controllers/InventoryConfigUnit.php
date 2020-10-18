<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfigUnit;

class InventoryConfigUnit extends Controller
{
    public function index(){
        $unit = ConfigUnit::all();
        return view('inventory/konfig/unit/index',["unit"=>$unit]);
    }
    public function add(){
        return view('inventory/konfig/unit/add');
    }
    public function store(Request $req){
        ConfigUnit::create([
            "name" => $req->input('unit')
        ]);
        return redirect()->route('inventory.config.unit.index');
    }
    public function edit($id){
        $unit = ConfigUnit::find($id);
        return view("inventory/konfig/unit/edit",["unit"=>$unit]);
    }
    public function update(Request $req, $id){
        $unit = ConfigUnit::find($id);
        $unit->name = $req->input('unit');
        $unit->save();
        return redirect()->route('inventory.config.unit.index');
    }
    public function delete($id){
        $unit = ConfigUnit::find($id);
        $unit->delete();
        return redirect()->route('inventory.config.unit.index');
    }
}
