<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Self_;

class DynamicAuthController extends Controller
{
 use AuthenticatesUsers;

     function username()
     {
         return 'login_id';
     }

    public function loginShow()
    {
        return view("login");
    }

    public function loginDo(Request $req)
    {
        $dbName =  "dynamic_auth_1";
        if(!$dbName == dynamicDatabaseConfig($dbName))
        {
           return "Invalid Database.";
        }

        if( \Auth::attempt(["login_id"=>$req->login_id ,"password"=>$req->password]) )
        {
           return redirect('dashboard');
            // return response()->json(["status"=>"success"]);
        }
        return response()->json(["status"=>"fail"]);
    }




}
