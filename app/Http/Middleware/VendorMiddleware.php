<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VendorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.'); //redirected to login page
            # code...
        }

        //check if user is vendor or not in users table
        if (Auth::user()->role !== 'vendor') {
            if($request->routeIs('home') || $request->routeIs('login')){
                return $next($request);
            }
            return redirect()->route('home')->with('error', 'You are not allowed to access this page');
            # code...
        }

        return $next($request);
    }
}
