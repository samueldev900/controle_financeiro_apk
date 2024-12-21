<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'user_cpf' => $this->generateCpf(), // Chama o gerador de CPF
            'user_cell' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    protected function generateCpf()
    {
        $numbers = [];
        for ($i = 0; $i < 9; $i++) {
            $numbers[] = rand(0, 9);
        }

        // Calcula o primeiro dígito verificador
        $d1 = 0;
        for ($i = 0, $j = 10; $i < 9; $i++, $j--) {
            $d1 += $numbers[$i] * $j;
        }
        $d1 = 11 - ($d1 % 11);
        $d1 = ($d1 >= 10) ? 0 : $d1;
        $numbers[] = $d1;

        // Calcula o segundo dígito verificador
        $d2 = 0;
        for ($i = 0, $j = 11; $i < 10; $i++, $j--) {
            $d2 += $numbers[$i] * $j;
        }
        $d2 = 11 - ($d2 % 11);
        $d2 = ($d2 >= 10) ? 0 : $d2;
        $numbers[] = $d2;

        // Retorna o CPF como string
        return implode('', $numbers); // Sem pontos e traço
    }

}
