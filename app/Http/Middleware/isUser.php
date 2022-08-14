<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class isUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
        if(Auth::check()){
            if(Auth::user()->status === 'active'){
                return $next($request);
            }
            return false;
            // echo Auth::user();
        //     Session::flash('error', 'Please Hold..Account is being verified');
        //     Session::flash('alert-class', 'alert-danger');
        // return redirect('/login')->withErrors([
        //     'isSuccess' => true,
        //     'message' => "Please Hold..Account is being verified"
        // ], 200);
        }

    else{
        $this->guard()->logout();
        return redirect('/login');
        // Session::flash('error', 'Please Hold..Account is being verified');
        //     Session::flash('alert-class', 'alert-danger');
        // return redirect('/login')->withErrors([
        //     'isSuccess' => true,
        //     'message' => "Please Hold..Account is being verified"
        // ], 200);

    }

    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
