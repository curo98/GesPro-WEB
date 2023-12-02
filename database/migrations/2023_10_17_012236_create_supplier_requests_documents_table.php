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
        Schema::create('supplier_requests_documents', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_supplier_request');
            $table->foreign('id_supplier_request')->references('id')->on('supplier_requests');

            $table->unsignedBigInteger('id_document');
            $table->foreign('id_document')->references('id')->on('documents');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_requests_documents');
    }
};
