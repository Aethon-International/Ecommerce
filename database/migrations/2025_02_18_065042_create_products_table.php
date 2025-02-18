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
        Schema::create('products', function (Blueprint $table) {
           
          
            $table->id();
            $table->string('name');
           
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 8, 2);
            $table->decimal('original_price', 8, 2)->nullable();
            $table->text('description')->nullable();
            $table->integer('quantity');
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active'); 
          
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
