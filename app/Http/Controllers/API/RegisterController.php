<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RegisterController as BaseRegisterController;

class RegisterController extends BaseRegisterController
{
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());

        return [
        	'message' => 'Registered',
            'access_token' => $user->api_token,
        ];
    }
}
