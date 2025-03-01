<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;
use App\Models\User;

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

        return $this->response('Credenciais inválidas. Verifique seu e-mail e senha e tente novamente.', 403);

    }

    public function logout(Request $request) 
    {   
        $request->user()->currentAccessToken()->delete();

        return $this->response('Token Reveked', 200);
    }

    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (sha1($user->getEmailForVerification()) === $hash) {
            // Verificar e atualizar o status de verificação
            $user->markEmailAsVerified();
            event(new Verified($user));

            return $this->response('E-mail verificado com sucesso', 200);
        }

        return $this->response('Link de verificação inválido', 400);
    }
}
