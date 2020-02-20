<?php

namespace App\Http\Controllers;



use App\Model\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DynamicAuthController extends Controller
{
/* use AuthenticatesUsers;


     function username()
     {
         return 'login_id';
     }*/

    public function loginShow()
    {
        return view("login");
    }

    public function loginDo(Request $req)
    {
      $data = dynamicAuthLogin( $req->dbName , $req->login_id , $req->password );

      return redirect()->route('home2',["token"=>enc($data['token'])]);

    }

    public function logOut()
    {
       Auth::logout();
       session()->invalidate();
       session()->flush();
       return redirect()->route('login');
    }






}
