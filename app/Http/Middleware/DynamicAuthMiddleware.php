<?php

namespace App\Http\Middleware;

use App\Http\Controllers\DynamicAuthController;
use Closure;
use Illuminate\Support\Facades\Auth;

class DynamicAuthMiddleware extends  DynamicAuthController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $database = dynamicDatabaseConfig(session()->get('myDatabase'));
        if( session()->get('myDatabase')  == $database  )
        {
            return $next($request);
        }
        return redirect()->route('logOut');
     //  return response()->json(['data'=>"unauthenticated user found."],401);
    }
}
