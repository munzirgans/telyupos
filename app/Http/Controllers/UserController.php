<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;


class UserController extends Controller
{
    public function index(){
        $client = new Client();
        $url = env("API_URL")."/users";
        $responseData = json_decode($client->get($url)->getBody()->getContents());
        return view('master/user/index', ['users' => collect($responseData)]);
    }
    public function add(){
        return view('master/user/add');
    }

    public function store(Request $req){
        $client = new Client();
        $url = env("API_URL")."/users";
        $data = [
            'name' => $req->input("name"),
            'email' => $req->input("email"),
            'password' => $req->input("password"),
            'address' => $req->input("address"),
            'phone' => $req->input('phone'),
            'level' => $req->input('level')
        ];
        $client->post($url, [
            'json' => $data
        ]);
        return redirect()->route('user.index');
    }

    public function edit($id){
        $users = Users::find($id);
        return view('master/user/edit',['user' => $users]);
    }

    public function update(Request $req, $id){
        $users = Users::find($id);
        $users->name = $req->input('name');
        $users->email = $req->input('email');
        $users->phone = $req->input('phone');
        $users->address = $req->input('address');
        $users->level = $req->input('level');
        $users->password = $req->input('password');
        $users->save();
        return redirect()->route('user.index');
    }
    public function delete($id){
        $client = new Client();
        $url = env("API_URL")."/users/".$id;
        $client->delete($url);
        return redirect()->route('user.index');
    }
    public function signin(Request $req){
        $client = new Client();
        $url = "http://localhost:8080/api/login";
        $data = [
            'email' => $req->email,
            'password' => $req->password,
        ];

        try{
            $response = $client->post($url, [
                'json' => $data,
            ]);
            Session::put("user", json_decode($response->getBody()));
            return redirect("/dashboard");
        }catch(\Exception $e){
            return view('signin')->with("msg", "Invalid username or password!");
        }
    }
}
