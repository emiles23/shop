<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Brand extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    protected $with = ['discounts', 'carts'];

    public function discounts(): MorphToMany
    {
        return $this->morphToMany(Discount::class, 'discountable');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function carts()
    {
        return $this->hasManyThrough(Cart::class, Product::class);
    }
}
