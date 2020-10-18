<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfigCategory;

class InventoryConfigCategory extends Controller
{
    public function index(){
        $category = ConfigCategory::all();
        return view('inventory/konfig/category/index',["category"=>$category]);
    }
    public function add(){
        return view('inventory/konfig/category/add');
    }
    public function store(Request $req){
        ConfigCategory::create([
            "name" => $req->input('category')
        ]);
        return redirect()->route('inventory.config.category.index');
    }
    public function edit($id){
        $category = ConfigCategory::find($id);
        return view("inventory/konfig/category/edit",["category"=>$category]);
    }
    public function update(Request $req, $id){
        $category = ConfigCategory::find($id);
        $category->name = $req->input('category');
        $category->save();
        return redirect()->route('inventory.config.category.index');
    }
    public function delete($id){
        $category = ConfigCategory::find($id);
        $category->delete();
        return redirect()->route('inventory.config.category.index');
    }
}
