<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use Auth;
use App\UserAccess;
use Route;

class Access
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
        $as = Route::getCurrentRoute()->getAction();
        $as = explode('.',$as['as'])[0];

        if(count(UserAccess::checkAccess(Auth::user()->id,$as)) == 0)
        {
            abort('404','Page Not Found');
        }
        
        return $next($request);
    }
}