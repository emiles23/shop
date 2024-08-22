<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'price', 'brand_id'];

    protected $with = ['brand.discounts', 'discounts'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function discounts(): MorphToMany
    {
        return $this->morphToMany(Discount::class, 'discountable');
    }
}