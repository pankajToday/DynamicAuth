<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Self_;

class DashboardController extends Controller
{
    function home(Request $req)
    {
          return   $req->token ;// Auth::user();
    }


    function home2( Request $req)
    {
        return   dnc($req->token);
    }


}
