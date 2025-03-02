<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parcelamento extends Model
{
    /** @use HasFactory<\Database\Factories\ParcelamentoFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'id_parcelamento';  
    protected $fillable = [
        'user_id',
        'descricao',
        'numero_parcelas',
        'valor_total',
        'primeiro_vencimento'
    ];
}
