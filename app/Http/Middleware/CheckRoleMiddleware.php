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
        if(Auth::user() !== null){
            $user = Auth::user();
            for($i = 0; $i<2 ; $i++){
                if(in_array($user->roles[$i]->role, $permission)){
                    return $next($request);
                }
                else abort(403);
            }
        }
        else{
            return redirect()->route('login');
        }
    }
}
