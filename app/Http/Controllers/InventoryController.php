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
use GuzzleHttp\Client;


class InventoryController extends Controller
{
    public function index(){
        $client = new Client();
        $url = env("API_URL")."/products";
        $responseData = json_decode($client->get($url)->getBody()->getContents());
        return view("inventory/produk/index",["product"=> collect($responseData)]);
    }
    public function add(){
        $category = ConfigCategory::all();
        $unit = ConfigUnit::all();
        $currency = ConfigCurrency::all();
        $profit = ConfigProfit::all();
        return view("inventory/produk/add",["category"=>$category,"unit"=>$unit,"currency"=>$currency,"profit"=>$profit]);
    }
    public function store(Request $req){
        $client = new Client();
        $url = env('API_URL')."/products";
        $data = [
            'barcode' => $req->input('barcode'),
            'name' => $req->input('name'),
            'stock' => $req->input('stock'),
            'purchase_price' => $req->input('purchase'),
            'selling_price'=> $req->input('selling'),
        ];
        $client->post($url, [
            'json' => $data
        ]);
        // IncomeItemReport::create([
        //     "barcode" => $req->input("barcode"),
        //     "name" => $req->input("name"),
        //     "quantity" => $req->input("stock"),
        //     "datetime" => Carbon::now()->format("Y-m-d H:i:s"),
        //     "via" => "Penambahan Produk Baru"
        // ]);
        return redirect()->route('inventory.product.index');
    }
    public function edit($id){
        $client = new Client();
        $url = env("API_URL")."/products/".$id;
        $responseData = json_decode($client->get($url)->getBody()->getContents());
        return view('inventory/produk/edit',["product"=>$responseData]);
    }
    public function delete($id){
        $client = new Client();
        $url = env("API_URL")."/products/".$id;
        $client->delete($url);
        return redirect()->route('inventory.product.index');
    }
    public function update(Request $req, $id){
        $client = new Client();
        $url = env("API_URL")."/products/".$id;
        $client->put($url, ['json' => $req->all()]);
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
        $client = new Client();
        $url = env("API_URL")."/products/".$id;
        $response = json_decode($client->get($url)->getBody());
        return view('inventory/produk/addstock')->with("product",$response);
    }
    public function updatestock(Request $req, $id){
        $client = new Client();
        $url = env("API_URL")."/products/stock/$id";
        $client->put($url,['json' => $req->all()]);
        return redirect()->route("inventory.product.index");
    }
    public function barcodedata(Request $req){
        $client = new Client();
        $url = env("API_URL")."/products/barcode";
        $response = json_decode($client->post($url,['json' => $req->all()])->getBody()->getContents());
        // $product = Product::where("barcode",$req->barcode)->get();
        return response()->json($response);
    }
    public function searchdata(Request $req){
        $product = Product::where('name', 'like', '%'.$req->name)
                    ->orWhere("name", "like", "%".$req->name."%")
                    ->orWhere("name", "like", $req->name."%")
                    ->get();
        return response()->json($product);
    }
}
