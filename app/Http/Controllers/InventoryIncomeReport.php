<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IncomeItemReport;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class InventoryIncomeReport extends Controller
{
    public function index(){
        $income = IncomeItemReport::all();
        $index = 0;
        foreach($income as $i){
            $income[$index]->date = Carbon::parse($income[$index]->datetime)->format("Y-m-d");
            $income[$index]->time = Carbon::parse($income[$index]->datetime)->format("H:i:s");
            $index += 1;
        }
        $now = Carbon::now();
        $date = $now->format("Y-m-d");
        $time = $now->format("H:i");

        return view('inventory/lap_barang_masuk/index',[
            "income"=>$income,
            "date"=>$date,
            "date2"=>$now->addDay()->format("Y-m-d"),
            "time" => $time,
            "time2" => $now->addHours(1)->format("H:i")
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
