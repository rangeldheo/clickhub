<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProduct extends Model
{
    use HasFactory;
    // Definindo o nome da tabela explicitamente, já que não segue o padrão pluralizado
    protected $table = 'client_product';

    // As colunas que podem ser preenchidas via mass assignment
    protected $fillable = [
        'client_id',
        'product_id',
    ];

    /**
     * Relacionamento com o modelo Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relacionamento com o modelo Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
