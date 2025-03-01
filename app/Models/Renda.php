<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Renda extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Define a tabela associada (caso o nome não siga o padrão Laravel)
    protected $table = 'renda';

    protected $primaryKey = 'renda_id';

    // Permite preenchimento em massa (mass assignment)
    protected $fillable = ['user_id', 'origin', 'tipo_renda', 'valor'];

    // Desativa timestamps (caso sua tabela não tenha `created_at` e `updated_at`)
    public $timestamps = false;
}
