<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::once($credentials)) {
            User::where('email', $request->email)->update([
                'api_token' => str_random(60)
            ]);

            $user = User::where('email', $request->email)->first();

            return [
                'access_token' => $user->api_token,
            ];
        }

        return [
            'message' => 'invalid_email_or_password',
        ];
    }
}
