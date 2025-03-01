<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    use HttpResponse;
    use HasApiTokens;
    /**
     * Display a listing of the resource.
     */

    //Escolher os métodos dessa classe que irao passar pelo auth(essa é uma das forma, mas nao vou usar ela).
/*     public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store', 'update', 'index']);
    } */

    public function index()
    {
        //collection serve para pegar mais de um dado de uma vez
        return UserResource::collection(User::with('family')->get());
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
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'user_cell' => 'required|regex:/^\(\d{2}\) \d{5}-\d{4}$/',
            'email' => 'required|email|unique:users,email',
            'family_id' => 'nullable|exists:families,id',
            'password' => 'required|min:8',
        ], [
            'first_name.required' => 'O nome é obrigatório.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'user_cell.regex' => 'Número de Telefone inválido'
        ]);
    
        // Verificando se a validação falhou
        if ($validator->fails()) {
            return $this->error('Dados Inválidos', 422, $validator->errors());
        }
    
        // Criando o usuário
        $created = User::create($validator->validated());
    
        // Se o usuário foi criado, envia a notificação de verificação de e-mail
        if ($created) {
            event(new Registered($created)); // Disparando o evento de registro
            $created->sendEmailVerificationNotification(); // Enviando a notificação de verificação
            return $this->response('Usuário Criado com Sucesso!', 200, new UserResource($created));
        }
    
        // Se o usuário não foi criado, retorna erro
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
    public function update(Request $request, User $user)
    {
        
       /*  if (!$user->tokenCan('user-update')) {
            return $this->error('Unauthorized', 403);
        } */
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'user_cell' => 'required|regex:/^\(\d{2}\) \d{5}-\d{4}$/',
            'email' => 'required|email|unique:users,email'
            //'password' => 'required|min:8',
        ], [
            'first_name.required' => 'O nome é obrigatório.',
            'email.unique' => 'Este e-mail já está cadastrado.',
        ]);

        if ($validator->fails()) {
            return $this->error('Dados Inválidos', 422, $validator->errors());
        }

        $validated = $validator->validated();

        $updated = $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'user_cell' => $validated['user_cell'],
            'email' => $validated['email'],
        ]);

        if ($updated) {
            return $this->response('Usuário atualizado com Sucesso!', 200, new UserResource($user));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $deleted = $user->delete();

        if ($deleted) {
            return $this->response('Usuário deletado', 200);
        }

        return $this->error('Erro: ao deletar usuário', 400);
    }
}
