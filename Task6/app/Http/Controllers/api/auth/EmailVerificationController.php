<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\apiResponse;
use App\Mail\VerificationCode;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    use apiResponse;

    private function verificationOperation($column, $value, $message, $request)
    {
        $token = $request->header('Authorization');
        $authUser = Auth::guard('sanctum')->user();
            $user = User::find($authUser->id);
            $user->{$column} = $value;
            $user->save();
            $user->token = $token;
            return $this->responseJson(200, $message, compact('user'));
    }

    public function sendCode(Request $request)
    {
        $user = User::find(Auth::guard('sanctum')->user()->id);
        Mail::to($user)->send(new VerificationCode($user));
        return $this->verificationOperation('code', rand(10000, 99999), 'Code Sent', $request);
    }

    public function verifyCode(Request $request)
    {
        return $this->verificationOperation(
            'email_verified_at',
            date('Y-m-d H:i:s'),
            "Email Verified Successfully",
            $request
        );
    }
}
