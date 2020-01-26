<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DynamicAuthMiddleware
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
       // dd(  session()->get('session_db') ,dynamicDatabaseConfig(session()->get('session_db'))   );

        if( session()->get('session_db')  &&
            session()->get('session_db') == dynamicDatabaseConfig(session()->get('session_db'))  )
        {
            return $next($request);
        }

        session()->flash('alt','danger');
        return redirect()->route('login')->with('message', 'Login-id or password not correct ');
     //  return response()->json(['data'=>"unauthenticated user found."],401);
    }
}
