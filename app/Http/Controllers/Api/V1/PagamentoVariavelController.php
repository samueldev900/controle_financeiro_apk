<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PagamentoVariavelResource;
use App\Models\PagamentoVariavel;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagamentoVariavelController extends Controller
{
    use HttpResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd('teste');
        return PagamentoVariavelResource::collection(PagamentoVariavel::all());
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
            'user_id' => 'required|exists:users,id',
            'descricao' => 'required|string',
            'valor' => 'required|numeric',
            'data_pagamento' => 'required|date',
        ], [
            'user_id.required' => 'O usuário responsável deve ser informado.',
            'user_id.numeric' => 'O usuário informado é inválido.',
            'user_id.exists' => 'O usuário selecionado não foi encontrado.',
        
            'descricao.required' => 'A descrição é obrigatória.',
            'descricao.string' => 'A descrição deve ser um texto válido.',
        
            'valor.required' => 'O valor é obrigatório.',
            'valor.numeric' => 'O valor deve ser um número válido.',
        
            'data_pagamento.required' => 'A data de pagamento é obrigatória.',
            'data_pagamento.date' => 'A data de pagamento deve ser uma data válida.'
        ]);
        

        if ($validator->fails()) {
            return $this->error('Dados Inválidos', 422, $validator->errors());
        }
    
        // Criando o usuário
        $created = PagamentoVariavel::create($validator->validated());
    
        // Se o usuário foi criado, envia a notificação de verificação de e-mail
        if ($created) {
            return $this->response('Pagamento Registrado com sucesso!', 200, new PagamentoVariavelResource($created));
        }
    
        // Se o usuário não foi criado, retorna erro
        return $this->error('Erro: Não foi possível registrar o Pagamento', 400, $validator->errors());

    }

    /**
     * Display the specified resource.
     */
    public function show(PagamentoVariavel $pagamentoVariavel)
    {
        return new PagamentoVariavelResource($pagamentoVariavel);
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
    public function update(Request $request, PagamentoVariavel $pagamentoVariavel)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'descricao' => 'required|string',
            'valor' => 'required|numeric',
            'data_pagamento' => 'required|date',
        ], [
            'user_id.required' => 'O usuário responsável deve ser informado.',
            'user_id.numeric' => 'O usuário informado é inválido.',
            'user_id.exists' => 'O usuário selecionado não foi encontrado.',
        
            'descricao.required' => 'A descrição é obrigatória.',
            'descricao.string' => 'A descrição deve ser um texto válido.',
        
            'valor.required' => 'O valor é obrigatório.',
            'valor.numeric' => 'O valor deve ser um número válido.',
        
            'data_pagamento.required' => 'A data de pagamento é obrigatória.',
            'data_pagamento.date' => 'A data de pagamento deve ser uma data válida.'
        ]);


        if ($validator->fails()) {
            return $this->error('Dados Inválidos', 422, $validator->errors());
        }
    
        $validated = $validator->validated();
        // Criando o usuário
        $updated = $pagamentoVariavel->update([
            'user_id' => $validated['user_id'],
            'descricao' => $validated['descricao'],
            'valor' => $validated['valor'],
            'data_pagamento' => $validated['data_pagamento'],
        ]);
    
        // Se o usuário foi criado, envia a notificação de verificação de e-mail
        if ($updated) {
            return $this->response('Parcelamento atualizado com sucesso!', 200, new PagamentoVariavelResource($pagamentoVariavel));
        }
    
        // Se o usuário não foi criado, retorna erro
        return $this->error('Erro: Não foi possível atualizar o parcelamento', 400, $validator->errors());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PagamentoVariavel $pagamentoVariavel)
    {   
        $deleted = $pagamentoVariavel->delete();

        if($deleted){
            return $this->response('Pagamento deletado com sucesso!', 200);
        }
        return $this->error('Erro: Não foi possível deletar o Pagamento', 400);
    }
}
