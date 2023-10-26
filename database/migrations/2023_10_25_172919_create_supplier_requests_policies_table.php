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
        Schema::create('supplier_requests_policies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_supplier_request');
            $table->unsignedBigInteger('id_policie');
            $table->boolean('accepted')->default(false); // Puede establecerse en falso por defecto

            $table->foreign('id_supplier_request')->references('id')->on('supplier_requests');
            $table->foreign('id_policie')->references('id')->on('policies');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_requests_policies');
    }
};
