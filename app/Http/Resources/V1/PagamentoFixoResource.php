<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PagamentoFixoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_pagamento_fixo,
            'user_id' => $this->user_id,
            'descricao' => $this->descricao,
            'valor' => $this->valor,
            'dia_vencimento' => $this->dia_vencimento,
        ];
    }
}
