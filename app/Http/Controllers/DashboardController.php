<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Report;
use App\IncomeItemReport;
use App\OutgoingItemReport;
use GuzzleHttp\Client;

class DashboardController extends Controller
{

    public function index(){
        $client = new Client();
        $url = env("API_URL")."/dashboard";
        $response = json_decode($client->get($url)->getBody());
        $product = $response->products;
        $report = Report::all();
        $income = $response->incoming;
        $outgoing = OutgoingItemReport::all();
        // dd(count($product));
        return view("dashboard",["product" => $product, "report"=> count($report), "income" => $income, "outgoing" => count($outgoing)]);
    }
}
