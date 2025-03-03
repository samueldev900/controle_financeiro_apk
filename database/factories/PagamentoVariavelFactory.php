<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PagamentoVariavel>
 */
class PagamentoVariavelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gastos = [
            'Corte de Cabelo',
            'Pizza',
            'Café da manhã',
            'Almoço',
            'Compras Mega box',
            'Compras Super Adega'
        ];

        return [
            'user_id' => User::all()->random()->id,
            'descricao' => $this->faker->randomElement($gastos),
            'valor' => $this->faker->randomFloat(2, 10, 120),
            'data_pagamento' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
