<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'value', 'type'];

    public function brands(): MorphToMany
    {
        return $this->morphedByMany(Brand::class, 'discountable');
    }

    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'discountable');
    }
}