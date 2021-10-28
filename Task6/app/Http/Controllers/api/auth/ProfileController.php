<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\apiResponse;

class ProfileController extends Controller
{
    use apiResponse;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = auth('sanctum')->user();
        $token = $request->header('Authorization');
        $user->token = $token;
        return $this->responseJson(200,"User's Profile", compact('user'));
    }
}
