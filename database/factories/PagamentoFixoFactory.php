<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PagamentoFixo>
 */
class PagamentoFixoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contas_fixas = [
            'Aluguel',
            'Condomínio',
            'Luz',
            'Água',
            'Internet',
            'Telefone',
            'TV a cabo',
            'Seguro do carro',
            'Seguro da casa',
            'Plano de saúde',
            'Mensalidade da academia',
            'Mensalidade da escola',
            'Mensalidade da faculdade',
            'Mensalidade do curso de inglês',
            'Mensalidade do curso de espanhol',
        ];

        return [
            'user_id' => User::all()->random()->id,
            'descricao' => $this->faker->randomElement($contas_fixas),
            'valor' => $this->faker->randomFloat(2, 0, 2000),
            'dia_vencimento' => $this->faker->randomElement([5, 10, 15, 20, 25]),
            'active' => $this->faker->boolean(),
        ];
    }
}
