<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'price', 'brand_id'];

    protected $with = ['brand.discounts', 'discounts', 'discount'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function discounts(): MorphToMany
    {
        return $this->morphToMany(Discount::class, 'discountable');
    }

    public function discount()
    {
        return $this->hasOneThrough(
            Discount::class,
            Discountable::class,
            'discountable_id',     // Foreign key on Discountable table
            'id',                  // Foreign key on Discount table
            'id',                  // Local key on the Product table
            'discount_id'          // Local key on Discountable table
        )
        ->where('discountables.discountable_type', Product::class)
        ->orderBy('discountables.created_at', 'desc');
    }
}