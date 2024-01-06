<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use \App\Product;
use \App\Store;
use \App\Report;
use GuzzleHttp\Client;

class PointofSale extends Controller
{
    private $client;
    private $apiURL;
    public function __construct(){
        $this->client = new Client();
        $this->apiURL = env("API_URL")."/pos";
    }
    public function index(){
        $response = json_decode($this->client->get($this->apiURL)->getBody()->getContents());
        $now = Carbon::now()->format("d/m/Y");
        $time_now = Carbon::now()->format("H:i:s");
        $report = Report::selectRaw("id_invoice")->whereDate("datetime","=", Carbon::now()->format("Y-m-d"))->groupBy("id_invoice")->get();
        $report_len = count($report) + 1;
        $name = \Session::get("user")->name;
        // $product = Product::all();
        $product = $response->products;
        $store = $response->toko;
        return view("pos/index",["now"=>$now,"name"=>$name, "product"=>$product,"store" => $store,"time"=> $time_now]);
    }
}
