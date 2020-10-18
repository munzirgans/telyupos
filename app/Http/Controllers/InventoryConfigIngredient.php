<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfigIngredient;

class InventoryConfigIngredient extends Controller
{
    public function index(){
        $ing = ConfigIngredient::all();
        return view('inventory/konfig/ingredient/index',["ing"=>$ing]);
    }
    public function add(){
        return view('inventory/konfig/ingredient/add');
    }
    public function edit($id){
        $ing = ConfigIngredient::find($id);
        return view('inventory/konfig/ingredient/edit')->with('ing',$ing);
    }
    public function update(Request $req, $id){
        $ing = ConfigIngredient::find($id);
        $ing->name = $req->input('ingredient');
        $ing->save();
        return redirect()->route('inventory.config.ingredient.index');
    }
    public function store(Request $req){
        ConfigIngredient::create([
            "name" => $req->input('ingredient')
        ]);
        return redirect()->route('inventory.config.ingredient.index');
    }
    public function delete($id){
        $ing = ConfigIngredient::find($id);
        $ing->delete();
        return redirect()->route('inventory.config.ingredient.index');
    }
}
