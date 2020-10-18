<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Report;
use App\IncomeItemReport;
use App\OutgoingItemReport;

class DashboardController extends Controller
{
    public function index(){
        $product = Product::all();
        $report = Report::all();
        $income = IncomeItemReport::all();
        $outgoing = OutgoingItemReport::all();
        // dd(count($product));
        return view("dashboard",["product" => count($product), "report"=> count($report), "income" => count($income), "outgoing" => count($outgoing)]);
    }
}
