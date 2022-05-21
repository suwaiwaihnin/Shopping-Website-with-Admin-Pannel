<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
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
       if(!Auth::check()){
           return redirect('/')->with('error','You Need To Login!');
       }
       $user = Auth::user();
       if($user->role !== 'admin'){
        return redirect('/')->with('info','You Are Not Admin Yet');
       }
        return $next($request);
    }
}
