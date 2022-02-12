<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        $user =  Auth::guard("api")->user();
        if($user->isAdmin()){
            return $next($request);
        }
        $response = ['errors' => "Unauthorized "];
        return response($response, 401);
    }
}
