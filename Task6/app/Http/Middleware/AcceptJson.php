<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Traits\apiResponse;

class AcceptJson
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
        if(! $request->wantsJson()) {
            return $this->responseJson(500,"Api Must Accept Json");
        }
        return $next($request);
    }
}
