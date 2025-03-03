<?php

namespace App\Http\Controllers\Api\V1;

use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Models\PagamentoFixo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\v1\PagamentoFixoResource;

class PagamentoFixoController extends Controller
{
    use HttpResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PagamentoFixoResource::collection(PagamentoFixo::all());
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
            'user_id' => 'required',
            'descricao' => 'required',
            'valor' => 'required',
            'dia_vencimento' => 'required',
        ]); 

        if ($validator->fails()) {
            return $this->error('Dados Inválidos', 422, $validator->errors());
        }
    
        // Criando o usuário
        $created = PagamentoFixo::create($validator->validated());
    
        // Se o usuário foi criado, envia a notificação de verificação de e-mail
        if ($created) {
            return $this->response('Pagamento Recorrente Registrado com sucesso!', 200, new PagamentoFixoResource($created));
        }
    
        // Se o usuário não foi criado, retorna erro
        return $this->error('Erro: Não foi possível registrar o Pagamento Recorrente', 400, $validator->errors());

    }

    /**
     * Display the specified resource.
     */
    public function show(PagamentoFixo $pagamentoFixo)
    {
        return new PagamentoFixoResource($pagamentoFixo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PagamentoFixo $pagamentoFixo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PagamentoFixo $pagamentoFixo)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'descricao' => 'required',
            'valor' => 'required',
            'dia_vencimento' => 'required',
        ]); 

        if ($validator->fails()) {
            return $this->error('Dados Inválidos', 422, $validator->errors());
        }
        
        $validated = $validator->validated();
        // Criando o usuário
        $updated = $pagamentoFixo->update([
            'user_id' => $validated['user_id'],
            'descricao' => $validated['descricao'],
            'valor' => $validated['valor'],
            'dia_vencimento' => $validated['dia_vencimento'],
        ]);
    
        // Se o usuário foi criado, envia a notificação de verificação de e-mail
        if ($updated) {
            return $this->response('Pagamento Recorrente Registrado com sucesso!', 200, new PagamentoFixoResource($pagamentoFixo));
        }
    
        // Se o usuário não foi criado, retorna erro
        return $this->error('Erro: Não foi possível registrar o Pagamento Recorrente', 400, $validator->errors());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PagamentoFixo $pagamentoFixo)
    {
        $deleted = $pagamentoFixo->delete();

        if($deleted){
            return $this->response('Pagamento Recorrente deletado com sucesso!', 200);
        }
        return $this->error('Erro: Não foi possível deletar o Pagamento Recorrente', 400);

    }
}
