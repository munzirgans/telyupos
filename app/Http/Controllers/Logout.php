<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class Logout extends Controller
{
    public function logout(){
        Session::flush();
        return redirect("/");
    }
}
