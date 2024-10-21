<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{   
    // Tabela produto
    protected $table = 'produto';
    
    // Desativa o uso automático de created_at e updated_at
    public $timestamps = false;
}
