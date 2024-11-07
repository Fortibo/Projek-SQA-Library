<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permission): Response
    {
        // if(Auth::user() !== null){
        //     $user = Auth::user();
        //     if($user->roles->isNotEmpty() && in_array($user->roles->first()->role, $permission)){
        //     }
        //     else abort(403);
        // }
        // else{
        //     return redirect()->route('login');
        // }
        
        return $next($request);
    }
}
