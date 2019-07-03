<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckUser
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
        $user = User::findorFail($request->profileId);
      
        if(!$user){ 
            return redirect()->back()->with('error', 'User does not exist.'); 
        }
        
        return $next($request);
    }
}
