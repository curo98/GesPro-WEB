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
        Schema::create('supplier_requests_questions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_supplier_request');
            $table->foreign('id_supplier_request')->references('id')->on('supplier_requests');

            $table->unsignedBigInteger('id_question');
            $table->foreign('id_question')->references('id')->on('questions');
            $table->boolean('response')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_requests_questions');
    }
};
