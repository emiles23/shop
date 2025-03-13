<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // protected $with = ['product'];

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'quantity', // Cantidad del producto
        'price',    // Precio con descuento
        'product_id', // ID del producto
        'user_id',   // ID del usuario
    ];

    /**
     * Obtener el producto asociado con el carrito.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Obtener el usuario asociado con el carrito.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}