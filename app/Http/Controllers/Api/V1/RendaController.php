<?php

namespace App\Http\Controllers\api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\RendaModel;

class RendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'valor' => 'required|numeric|min:0',
        ], [
            'user_id.required' => 'O usuário é obrigatório.',
            'user_id.exists' => 'O usuário informado não existe.',
            'origin.required' => 'A origem da renda é obrigatória.',
            'tipo_renda.required' => 'O tipo da renda é obrigatório.',
            'valor.required' => 'O valor é obrigatório.',
            'valor.numeric' => 'O valor deve ser um número.',
            'valor.min' => 'O valor não pode ser negativo.',
        ]);
    
        // Se a validação falhar, retorna os erros
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
    
        // Criação da nova renda
        $renda = RendaModel::create([
            'user_id' => $request->user_id,
            'origin' => $request->origin,
            'tipo_renda' => $request->tipo_renda,
            'valor' => $request->valor,
        ]);
    
        // Retorna a resposta de sucesso'
        return response()->json([
            'success' => true,
            'message' => 'Renda registrada com sucesso!',
            'data' => $renda
        ], 201);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
