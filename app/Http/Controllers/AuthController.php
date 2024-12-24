<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponse;

    public function login(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password'))){
            return $this->response('Autorized', 200, [
                'token' => $request->user()->createToken('user',['user-update'])->plainTextToken
            ]);
        }

        return $this->response('Not Authorized', 403);

    }

    public function logout(Request $request) 
    {   
        $request->user()->currentAccessToken()->delete();

        return $this->response('Token Reveked', 200);
    }
}
