<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use \App\Product;
use \App\Store;
use \App\Report;

class PointofSale extends Controller
{
    public function index(){
        $now = Carbon::now()->format("d/m/Y");
        $time_now = Carbon::now()->format("H:i:s");
        $report = Report::selectRaw("id_invoice")->whereDate("datetime","=", Carbon::now()->format("Y-m-d"))->groupBy("id_invoice")->get();
        $report_len = count($report) + 1;
        $invoice = "POSTEN".Carbon::now()->format("Ymd").sprintf("%04d",$report_len);
        $name = \Session::get("user")->name;
        $product = Product::all();
        $store = Store::first();
        return view("pos/index",["now"=>$now,"name"=>$name, "product"=>$product,"invoice" => $invoice,"store" => $store,"time"=> $time_now]);
    }
}
