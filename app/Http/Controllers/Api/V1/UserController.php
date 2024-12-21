<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use HttpResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //collection serve para pegar mais de um dado de uma vez
        return UserResource::collection(User::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'user_cpf' => 'required|digits:11',
            'user_cell' => 'required|regex:/^\(\d{2}\) \d{5}-\d{4}$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'first_name.required' => 'O nome é obrigatório.',
            'email.unique' => 'Este e-mail já está cadastrado.',
        ]);

        if($validator->fails()){
            return $this->error('Dados Inválidos', 422, $validator->errors());
        }

        $created = User::create(($validator->validated()));

        if($created){
            return $this->response('Usuário Criado com Sucesso!', 200, new UserResource($created));
        }
        return $this->error('Erro: Usuário não foi criado', 400, $validator->errors());
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //USAR O 'NEW'
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
