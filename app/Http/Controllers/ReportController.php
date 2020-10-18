<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index(){
        $report = Report::groupBy("id_invoice","additional_discount","cash","change_cash","datetime")
                    ->selectRaw("id_invoice,sum(quantity) as quantity, sum(price) as price, sum(discount) as discount, additional_discount as add_discount, cash, change_cash,datetime")
                    ->orderBy("datetime","asc")
                    ->get();
        foreach($report as $r){
            $r->date = explode(" ", $r->datetime)[0];
            $r->date = str_replace("-", "/", $r->date);
            $r->time = explode(" ", $r->datetime)[1];
        }
        $name = Report::select("name","id_invoice")->orderBy("datetime","asc")->get()->toArray();
        $quantity = Report::select("quantity","id_invoice")->orderBy("datetime","asc")->get()->toArray();
        $price = Report::select("price","id_invoice")->orderBy("datetime","asc")->get()->toArray();
        $discount = Report::select("discount","id_invoice")->orderBy("datetime","asc")->get()->toArray();
        // dd($report);
        return view("report/index",["report"=>$report,"name"=>$name,"quantity"=>$quantity,"price"=>$price,"discount"=>$discount]);
    }
    public function store(Request $req){
        for ($i = 0 ; $i < count($req->name); $i++){
            Report::create([
                "id_invoice" => $req->invoice,
                "name" => $req->name[$i],
                "quantity" => $req->quantity[$i],
                "price" => $req->price[$i],
                "discount" => $req->discount[$i],
                "additional_discount" => $req->add_discount,
                "cash" => $req->cash,
                "change_cash" => str_replace(",", "", $req->kembalian),
                "datetime" => Carbon::now()->format("Y-m-d H:i:s"),
            ]);
        };
    }
}
