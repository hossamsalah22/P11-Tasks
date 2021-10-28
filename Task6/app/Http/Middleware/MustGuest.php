<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\apiResponse;

class MustGuest
{
    use apiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('sanctum')->check()) {
            return $this->responseJson(401,"You can't Access This Api While Logged In");
        }
        return $next($request);
    }
}
