<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RendaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'origin' => $this->origin,
            'tipo_renda' => $this->tipo_renda,
            'valor' => $this->valor,
            'user' => [

                //  'first_name' => $this->user->first_name,
                //'last_name' => $this->user->last_name,
                'full_name' => $this->user->first_name . " " . $this->user->last_name,
                //'user_cpf' => $this->user->user_cpf,
                'cell_phone' => $this->user->user_cell,
                //'family_id' => $this->user->family,
                'email' => $this->user->email,


            ],
        ];
    }
}
