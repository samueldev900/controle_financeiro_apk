<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parcelamento>
 */
class ParcelamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $produtos = [
            'Notebook Dell XPS', 'MacBook Pro', 'Smartphone Samsung Galaxy', 'iPhone 14 Pro',  
            'Monitor LG Ultrawide', 'Teclado Mecânico RGB', 'Mouse Logitech MX Master',  
            'Fone Bluetooth JBL', 'Caixa de Som Alexa', 'Smartwatch Garmin',  
            'Geladeira Brastemp Frost Free', 'Fogão 5 Bocas Electrolux', 'Micro-ondas Panasonic',  
            'Máquina de Lavar Samsung', 'Aspirador de Pó Xiaomi', 'Ar-condicionado Split LG',  
            'TV 4K Samsung 55"', 'PlayStation 5', 'Xbox Series X', 'Nintendo Switch OLED',  
            'Bicicleta Caloi Aro 29', 'Patinete Elétrico Xiaomi', 'Câmera Canon EOS Rebel',  
            'Drone DJI Mini 3', 'Impressora HP LaserJet', 'Cadeira Gamer ThunderX3',  
            'Mesa para Home Office', 'Mochila para Notebook Samsonite', 'SSD NVMe 1TB Kingston',  
            'Placa de Vídeo RTX 4080', 'Memória RAM 32GB Corsair'
        ];
        
        return [
            'user_id' => User::all()->random()->id,
            'descricao' => $this->faker->randomElement($produtos),
            'numero_parcelas' =>  $this->faker->numberBetween(1,19),
            'valor_total' => $this->faker->randomFloat(2, 100, 2500),
            'primeiro_vencimento' => $this->faker->dateTimeBetween('now', '+2 month'),
        ];
    }
}
