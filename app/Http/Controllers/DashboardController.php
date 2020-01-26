<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Self_;

class DashboardController extends Controller
{
    function home()
    {
        if( Auth::check())
        {
            return Auth::user();
        }
        return 0;
    }


    function home2()
    {
        return Auth::user();
    }


}
