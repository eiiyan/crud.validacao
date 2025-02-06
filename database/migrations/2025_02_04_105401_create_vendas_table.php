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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id')->foreignId('cliente_id')->references('id')->on('cliente_id');
            $table->timestamp('data_venda')->nullable(false);
            $table->decimal('subtotal', 10,2)->nullable(false);
            $table->decimal('desconto', 10,2)->nullable(true);
            $table->decimal('total', 15,2)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
