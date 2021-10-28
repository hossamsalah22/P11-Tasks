<?php

namespace App\Http\Controllers\api\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\apiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\api\LoginRequest;

class LoginController extends Controller
{
    use apiResponse;
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->responseJson(422, "Wrong Email or Password");
        }
        $user->token = "Bearer " . $user->createToken($request->device_name)->plainTextToken;
        if (!$user->email_verified_at) {
            return $this->responseJson(401, "User Not Verified", compact('user'));
        }
        return $this->responseJson(200, "Login Success", compact('user'));
    }

    public function logout()
    {
        // $request->user()->currentAccessToken()->delete();
        $user = auth('sanctum')->user();
        if ($user) {
            $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
            return $this->responseJson(200, "Logged Out Successfully");
        } else {
            return $this->responseJson(422, "User Not Logged In");
        }
    }

    public function logoutFromAllDevices()
    {
        $user = auth('sanctum')->user();
        if ($user) {
            $user->tokens()->delete();
            return $this->responseJson(200, "Logged Out Successfully From All Devices");
        } else {
            return $this->responseJson(422, "User Not Logged In");
        }
    }
}
