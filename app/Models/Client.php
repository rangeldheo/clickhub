<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Chave estrangeira para o usuário
        'address',
        'zipcode',
        'city',
        'uf',
    ];

    // Define a relação com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'client_product')->withTimestamps();
    }
}
