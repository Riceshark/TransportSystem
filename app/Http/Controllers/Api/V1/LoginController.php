<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Auth;

class LoginController
{
    public $successStatus = 200;

    /**
     * Login API
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }

        return response()->json(['error' => 'Unauthorised'], 401);
    }
}