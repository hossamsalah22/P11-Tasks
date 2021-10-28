<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\NewPasswordRequest;
use App\Http\Requests\api\VerifyEmailRequest;
use App\Models\User;
use App\Http\Traits\apiResponse;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    use apiResponse;
    public function verifyEmail(VerifyEmailRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->token = "Bearer " . $user->createToken($request->device_name)->plainTextToken;
        return $this->responseJson(200, "Email Exists", compact('user'));
    }

    public function setNewPassword(NewPasswordRequest $request)
    {
        $authUser = auth('sanctum')->user();
        $user = User::find($authUser->id);
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return $this->responseJson(422, "New Password Connot Be The old Password");
            }
            $user->password = Hash::make($request->password);
            $user->save();
            $user->token = $request->header('Authrization');
            return $this->responseJson(200, "Password Updated", compact('user'));
        } else {
            return $this->responseJson(422, "User Not Found");
        }
    }
}
