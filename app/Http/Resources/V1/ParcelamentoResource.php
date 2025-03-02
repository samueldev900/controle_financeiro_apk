<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParcelamentoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'descricao' => $this->descricao,
            'numero_parcelas' => $this->numero_parcelas,
            'valor_total' => $this->valor_total,
            'primeiro_vencimento' => $this->primeiro_vencimento,
        ];
    }
}
