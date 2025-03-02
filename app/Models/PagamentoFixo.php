<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagamentoFixo extends Model
{
    /** @use HasFactory<\Database\Factories\PagamentoFixoFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id_pagamento_fixo';
    protected $table = 'pagamento_fixo';
    protected $fillable = [
        'user_id',
        'descricao',
        'valor',
        'dia_vencimento',
        'active'
    ];
}
