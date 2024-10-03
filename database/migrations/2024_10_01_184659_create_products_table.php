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
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade'); // Relaciona com a tabela de suppliers
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Relaciona com a tabela de categories
            $table->string('name'); // Nome do produto
            $table->text('description')->nullable(); // Descrição do produto
            $table->decimal('price', 10, 2); // Preço do produto
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
