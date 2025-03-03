<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagamentoVariavel extends Model
{
    /** @use HasFactory<\Database\Factories\PagamentoVariavelFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pagamento_variavel';
    protected $primaryKey = 'id_pagamento_variavel';
    protected $fillable = ['user_id', 'descricao', 'valor', 'data_pagamento'];

    
}
