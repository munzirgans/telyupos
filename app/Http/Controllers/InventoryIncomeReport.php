<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IncomeItemReport;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class InventoryIncomeReport extends Controller
{
    private $client;
    private $apiURL;
    public function __construct(){
        $this->client = new Client();
        $this->apiURL = env("API_URL")."/report/incoming";
    }
    public function index(){
        $response = json_decode($this->client->get($this->apiURL)->getBody()->getContents());
        return view('inventory/lap_barang_masuk/index',[
            "income"=>$response,
        ]);
    }
    public function rangedate(Request $req){
        $income = DB::table('income_item_reports')
                ->select(DB::raw("barcode,name,quantity,date(datetime) as date,time(datetime) as time,via"))
                ->whereBetween("datetime", [$req->from_date, $req->to_date])
                ->get();
        return response()->json($income);
    }
    public function rangetime(Request $req){
        $income = DB::table('income_item_reports')
                    ->select(DB::raw("barcode,name,quantity,date(datetime) as date,time(datetime) as time,via"))
                    ->whereTime("datetime", ">", $req->from_time.":00")
                    ->whereTime("datetime", "<", $req->to_time.":00")
                    ->get();
        return response()->json($income);
    }
    public function rangedatetime(Request $req){
        $income = DB::table('income_item_reports')
                    ->select(DB::raw("barcode,name,quantity,date(datetime) as date,time(datetime) as time,via"))
                    ->whereBetween("datetime", [$req->from_date." ".$req->from_time, $req->to_date." ".$req->to_time])
                    ->get();
        return response()->json($income);
    }
    public function alldata(Request $req){
        $income = DB::table('income_item_reports')
                ->select(DB::raw("barcode,name,quantity,date(datetime) as date,time(datetime) as time,via"))
                ->get();
        return response()->json($income);
    }
}
