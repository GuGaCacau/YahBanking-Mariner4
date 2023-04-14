<?php

// Migração da relação entre Clientes e Investimentos (Many to Many)

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
        Schema::create('client_investment', function (Blueprint $table) {
            
            //Chaves Estrangeiras das duas tabelas
            $table->foreignId('client_id')->constrained();
            $table->foreignId('investment_id')->constrained();

            $table->float('investment_amount', 8, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_investment');
    }
};
