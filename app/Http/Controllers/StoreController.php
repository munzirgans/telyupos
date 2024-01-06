<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use File;
use GuzzleHttp\Client;

class StoreController extends Controller
{
    private $client;
    private $apiURL;
    public function __construct(){
        $this->client = new Client();
        $this->apiURL = env("API_URL")."/toko";
    }
    public function index(){
        $response = json_decode($this->client->get($this->apiURL)->getBody()->getContents());
        return view('master/store/index',['store' => $response]);
    }
    public function edit(){
        $response = json_decode($this->client->get($this->apiURL)->getBody()->getContents());
        return view('master/store/edit',['store' => $response]);
    }
    public function update(Request $req){
        $this->client->put($this->apiURL, ['json' => $req->all()]);
        return redirect()->route('store.index');
    }
}
