<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Http\Traits\apiResponse;
use Illuminate\Support\Facades\Auth;

class VerifiedUser
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

        if(! Auth::guard('sanctum')->user()->email_verified_at) {
            return $this->responseJson(422,"Not Verified User");
        }

        return $next($request);
    }
}
