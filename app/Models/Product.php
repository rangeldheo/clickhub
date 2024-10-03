<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'category_id',
        'name',
        'description',
        'price',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_product');
    }

    // App\Models\Product.php

    public function clientProducts()
    {
        return $this->hasMany(ClientProduct::class); // Ajuste o nome da classe se necessário
    }
}
