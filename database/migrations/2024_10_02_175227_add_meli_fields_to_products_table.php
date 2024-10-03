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
        Schema::table('products', function (Blueprint $table) {
            $table->string('meli_id')->nullable()->after('id'); // Adiciona o campo meli_id
            $table->text('meli_json')->nullable()->after('meli_id'); // Adiciona o campo meli_json
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('meli_id'); // Remove o campo meli_id
            $table->dropColumn('meli_json'); // Remove o campo meli_json
        });
    }
};
