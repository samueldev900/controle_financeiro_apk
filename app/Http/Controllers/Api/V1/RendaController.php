<?php

namespace App\Http\Controllers\api\V1;

use App\Models\Renda;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\RendaResource;
use Illuminate\Support\Facades\Validator;

class RendaController extends Controller
{
    use HttpResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RendaResource::collection(Renda::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */

    
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'origin' => 'required|string',
            'tipo_renda' => 'required|string',
            'valor' => 'required|numeric|between:1,9999.99',
        ], [
            'user_id.required' => 'O usuário é obrigatório.',
            'user_id.exists' => 'O usuário informado não existe.',
            'origin.required' => 'A origem da renda é obrigatória.',
            'tipo_renda.required' => 'O tipo da renda é obrigatório.',
            'valor.required' => 'O valor é obrigatório.',
            'valor.numeric' => 'O valor deve ser um número.',
            'valor.min' => 'O valor não pode ser negativo.',
        ]);
    
        if ($validator->fails()) {
            return $this->error('Dados Inválidos', 422, $validator->errors());
        }
    
        // Criando o usuário
        $created = Renda::create($validator->validated());
    
        // Se o usuário foi criado, envia a notificação de verificação de e-mail
        if ($created) {
            return $this->response('Usuário Criado com Sucesso!', 200, new RendaResource($created));
        }
    
        // Se o usuário não foi criado, retorna erro
        return $this->error('Erro: Usuário não foi criado', 400, $validator->errors());
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Renda $renda)
    {
        return new RendaResource($renda);
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
    public function update(Request $request, Renda $renda)
    {
         // Validação dos dados recebidos
         $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'origin' => 'required|string',
            'tipo_renda' => 'required|string',
            'valor' => 'required|numeric|between:1,9999.99',
        ], [
            'user_id.required' => 'O usuário é obrigatório.',
            'user_id.exists' => 'O usuário informado não existe.',
            'origin.required' => 'A origem da renda é obrigatória.',
            'tipo_renda.required' => 'O tipo da renda é obrigatório.',
            'valor.required' => 'O valor é obrigatório.',
            'valor.numeric' => 'O valor deve ser um número.',
            'valor.min' => 'O valor não pode ser negativo.',
        ]);


        if ($validator->fails()) {
            return $this->error('Dados Inválidos', 422, $validator->errors());
        }
    
        $validated = $validator->validated();
        // Criando o usuário
        $updated = $renda->update([
            'user_id' => $validated['user_id'],
            'origin' => $validated['origin'],
            'tipo_renda' => $validated['tipo_renda'],
            'valor' => $validated['valor'],
        ]);
    
        // Se o usuário foi criado, envia a notificação de verificação de e-mail
        if ($updated) {
            return $this->response('Renda Atualizada com sucesso!', 200, new RendaResource($renda));
        }
    
        // Se o usuário não foi criado, retorna erro
        return $this->error('Erro: Usuário não foi criado', 400, $validator->errors());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Renda $renda)
    {
        $deleted = $renda->delete();

        if ($deleted) {
            return $this->response('Renda deletada', 200);
        }

        return $this->error('Erro: ao deletar renda', 400);
    }
}
