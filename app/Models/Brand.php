<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Brand extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];


    public function discounts(): MorphToMany
    {
        return $this->morphToMany(Discount::class, 'discountable');
    }
}
