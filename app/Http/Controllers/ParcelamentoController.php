<?php

namespace App\Http\Controllers;

use App\Models\Parcelamento;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ParcelamentoResource;
use Illuminate\Support\Facades\Validator;

class ParcelamentoController extends Controller
{
    use HttpResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Parcelamento::all();
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
        $validator = Validator::make($request->all(),[
            'user_id' => 'required|exists:users,id',
            'descricao' => 'required|string',
            'numero_parcelas' => 'required|numeric|between:2,18',
            'valor_total' => 'required|numeric|between:1,9999.99',
            'primeiro_vencimento' => 'required|date',
        ],[
            'user_id.required' => 'O usuário é obrigatório.',
            'user_id.exists' => 'O usuário informado não existe.',
            'descricao.required' => 'A descrição é obrigatória.',
            'numero_parcelas.required' => 'O número de parcelas é obrigatório.',
            'numero_parcelas.numeric' => 'O número de parcelas deve ser um número.',
            'numero_parcelas.between' => 'O número de parcelas deve ser entre 2 e 18.',
            'valor_total.required' => 'O valor total é obrigatório.',
            'valor_total.numeric' => 'O valor total deve ser um número.',
            'valor_total.between' => 'O valor total deve ser entre 1 e 9999.99.',
            'primeiro_vencimento.required' => 'O primeiro vencimento é obrigatório.',
            'primeiro_vencimento.date' => 'O primeiro vencimento deve ser uma data válida.',
        ]);

        
        if ($validator->fails()) {
            return $this->error('Dados Inválidos', 422, $validator->errors());
        }
    
        // Criando o usuário
        $created = Parcelamento::create($validator->validated());
    
        // Se o usuário foi criado, envia a notificação de verificação de e-mail
        if ($created) {
            return $this->response('Parcelamento Registrado com sucesso!', 200, new ParcelamentoResource($created));
        }
    
        // Se o usuário não foi criado, retorna erro
        return $this->error('Erro: Não foi possível registrar o parcelamento', 400, $validator->errors());

    }

    /**
     * Display the specified resource.
     */
    public function show(Parcelamento $parcelamento)
    {
        return new ParcelamentoResource($parcelamento);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parcelamento $parcelamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parcelamento $parcelamento)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required|exists:users,id',
            'descricao' => 'required|string',
            'numero_parcelas' => 'required|numeric|between:2,18',
            'valor_total' => 'required|numeric|between:1,9999.99',
            'primeiro_vencimento' => 'required|date',
        ],[
            'user_id.required' => 'O usuário é obrigatório.',
            'user_id.exists' => 'O usuário informado não existe.',
            'descricao.required' => 'A descrição é obrigatória.',
            'numero_parcelas.required' => 'O número de parcelas é obrigatório.',
            'numero_parcelas.numeric' => 'O número de parcelas deve ser um número.',
            'numero_parcelas.between' => 'O número de parcelas deve ser entre 2 e 18.',
            'valor_total.required' => 'O valor total é obrigatório.',
            'valor_total.numeric' => 'O valor total deve ser um número.',
            'valor_total.between' => 'O valor total deve ser entre 1 e 9999.99.',
            'primeiro_vencimento.required' => 'O primeiro vencimento é obrigatório.',
            'primeiro_vencimento.date' => 'O primeiro vencimento deve ser uma data válida.',
        ]);

        
        if ($validator->fails()) {
            return $this->error('Dados Inválidos', 422, $validator->errors());
        }
    
        $validated = $validator->validated();
        // Criando o usuário
        $updated = $parcelamento->update([
            'user_id' => $validated['user_id'],
            'descricao' => $validated['descricao'],
            'numero_parcelas' => $validated['numero_parcelas'],
            'valor_total' => $validated['valor_total'],
            'primeiro_vencimento' => $validated['primeiro_vencimento'],
        ]);
    
        // Se o usuário foi criado, envia a notificação de verificação de e-mail
        if ($updated) {
            return $this->response('Parcelamento atualizado com sucesso!', 200, new ParcelamentoResource($parcelamento));
        }
    
        // Se o usuário não foi criado, retorna erro
        return $this->error('Erro: Não foi possível atualizar o parcelamento', 400, $validator->errors());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parcelamento $parcelamento)
    {
        $deleted = $parcelamento->delete();

        if($deleted){
            return $this->response('Parcelamento deletado com sucesso!', 200);
        }
        return $this->error('Erro: Não foi possível deletar o parcelamento', 400);
    }
}
