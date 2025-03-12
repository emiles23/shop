<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('quantity')->default(1); // Cantidad del producto
            $table->decimal('price', total: 8, places: 2)->default(0); // Precio con descuento  
            // Claves foráneas 
            $table->foreignId('product_id');// ID del producto
            $table->foreignId('user_id');// ID del producto         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};