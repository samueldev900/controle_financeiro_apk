<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Family;
use App\Models\Parcelamento;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PagamentoFixo;
use App\Models\PagamentoVariavel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Family::factory(10)->create();
        //User::factory(10)->create();
        //Parcelamento::factory(10)->create();
        
        //PagamentoFixo::factory(10)->create();
        PagamentoVariavel::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
    }
}
