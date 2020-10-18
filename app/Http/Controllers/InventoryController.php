<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Product;
use App\ConfigCategory;
use App\ConfigUnit;
use App\ConfigCurrency;
use App\ConfigProfit;
use App\IncomeItemReport;

class InventoryController extends Controller
{
    public function index(){
        $product = Product::all();
        $category = ConfigCategory::all();
        return view("inventory/produk/index",["product"=> $product,"category"=>$category]);
    }
    public function add(){
        $category = ConfigCategory::all();
        $unit = ConfigUnit::all();
        $currency = ConfigCurrency::all();
        $profit = ConfigProfit::all();
        return view("inventory/produk/add",["category"=>$category,"unit"=>$unit,"currency"=>$currency,"profit"=>$profit]);
    }
    public function store(Request $req){
        Product::create([
            'barcode' => $req->input('barcode'),
            'name' => $req->input('name'),
            'category' => $req->input('category'),
            'stock' => $req->input('stock'),
            'curr' => $req->input('curr'),
            'purchase_price' => $req->input('purchase'),
            'selling_price'=> $req->input('selling'),
            'discount' => $req->input("discount"),
            'unit' => $req->input('unit'),
        ]);
        IncomeItemReport::create([
            "barcode" => $req->input("barcode"),
            "name" => $req->input("name"),
            "quantity" => $req->input("stock"),
            "datetime" => Carbon::now()->format("Y-m-d H:i:s"),
            "via" => "Penambahan Produk Baru"
        ]);
        return redirect()->route('inventory.product.index');
    }
    public function edit($id){
        $product = Product::find($id);
        $category = ConfigCategory::all();
        $unit = ConfigUnit::all();
        $currency = ConfigCurrency::all();
        $profit = ConfigProfit::all();
        return view('inventory/produk/edit',["product"=>$product,"category"=>$category,"unit"=>$unit,"currency"=>$currency,"profit"=>$profit]);
    }
    public function delete($id){
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('inventory.product.index');
    }
    public function update(Request $req, $id){
        $product = Product::find($id);
        $product->barcode = $req->input('barcode');
        $product->name = $req->input('name');
        $product->category = $req->input('category');
        $product->stock = $req->input('stock');
        $product->curr = $req->input('curr');
        $product->purchase_price = $req->input('purchase');
        $product->selling_price = $req->input('selling');
        $product->unit = $req->input('unit');
        $product->save();
        return redirect()->route('inventory.product.index');
    }
    public function data(Request $req){
        $product = Product::where("category", $req->category)->get();
        return response()->json($product);
    }
    public function alldata(){
        $product = Product::all();
        return response()->json($product);
    }
    public function addstock($id){
        $product = Product::find($id);
        return view('inventory/produk/addstock')->with("product",$product);
    }
    public function updatestock(Request $req, $id){
        $product = Product::find($id);
        $product->stock = $product->stock + $req->input('stock');
        $product->save();
        IncomeItemReport::create([
            "barcode" => $product->barcode,
            "name" => $product->name,
            "quantity" => $req->input('stock'),
            "datetime" => Carbon::now()->format("Y-m-d H:i:s"),
            "via" => "Penambahan Stock"
        ]);
        return redirect()->route("inventory.product.index");
    }
    public function barcodedata(Request $req){
        $product = Product::where("barcode",$req->barcode)->get();
        return response()->json($product);
    }
    public function searchdata(Request $req){
        $product = Product::where('name', 'like', '%'.$req->name)
                    ->orWhere("name", "like", "%".$req->name."%")
                    ->orWhere("name", "like", $req->name."%")
                    ->get();
        return response()->json($product);
    }
}
