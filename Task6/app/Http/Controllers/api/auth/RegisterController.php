<?php

namespace App\Http\Controllers\api\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\api\RegisterRequest;
use App\Http\Traits\apiResponse;

class RegisterController extends Controller
{
    use apiResponse;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        $userData = $request->validated();
        $userData['password'] = Hash::make($request->password);
        $user = User::create($userData);
        $user->token = "Bearer " . $user->createToken($request->device_name)->plainTextToken;
        if ($user) {
            return $this->responseJson(200, "Register Completed Successfully", compact('user'));
        } else {
            return $this->responseJson(422, "Something Went Wrong, Try again");
        }
    }
}
