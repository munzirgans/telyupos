<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\OutgoingItemReport;
use Illuminate\Support\Facades\DB;


class InventoryOutgoingReport extends Controller
{
    public function index(){
        $outgoing = OutgoingItemReport::all();
        $now = Carbon::now();
        foreach($outgoing as $o){
            $o->date = explode(" ", $o->datetime)[0];
            $o->time = explode(" ", $o->datetime)[1];
        }
        $date = $now;
        $time = $now->format("H:i");
        return view('inventory/lap_barang_keluar/index',[
            "outgoing" => $outgoing,
            "date"=>$date->format("Y-m-d"),
            "date2"=>$now->addDay()->format("Y-m-d"),
            "time"=>$time,
            "time2" => $now->addHours(1)->format("H:i")
        ]);
    }
    public function allData(Request $req){
        $outgoing = OutgoingItemReport::all();
        foreach($outgoing as $o){
            $o->date = explode(" ", $o->datetime)[0];
            $o->time = explode(" ", $o->datetime)[1];
        }
        return response()->json($outgoing);
    }
    public function rangeDate(Request $req){
        $outgoing = DB::table('outgoing_item_reports')
                ->select(DB::raw("barcode,name,quantity,date(datetime) as date,time(datetime) as time,via"))
                ->whereBetween("datetime", [$req->from_date, $req->to_date])
                ->get();
        return response()->json($outgoing);
    }
    public function rangeTime(Request $req){
        $outgoing = DB::table('outgoing_item_reports')
                    ->select(DB::raw("barcode,name,quantity,date(datetime) as date,time(datetime) as time,via"))
                    ->whereTime("datetime", ">", $req->from_time.":00")
                    ->whereTime("datetime", "<", $req->to_time.":00")
                    ->get();
        return response()->json($outgoing);
    }
    public function rangeDateTime(Request $req){
        $outgoing = DB::table('outgoing_item_reports')
                    ->select(DB::raw("barcode,name,quantity,date(datetime) as date,time(datetime) as time,via"))
                    ->whereBetween("datetime", [$req->from_date." ".$req->from_time, $req->to_date." ".$req->to_time])
                    ->get();
        return response()->json($outgoing);
return response()->json($income);
    }
    public function store(Request $req){
        try {
            $datetime = Carbon::now()->format("Y-m-d H:i:s");
            for($i = 0;$i < count($req->barcode);$i++){
                OutgoingItemReport::create([
                    "barcode" => $req->barcode[$i],
                    "name" => $req->name[$i],
                    "quantity" => $req->quantity[$i],
                    "datetime" => $datetime,
                    "via" => $req->via
                ]);
            };
        }
        catch(\Exception $e){
            return response()->json($e);
        }
    }
}
