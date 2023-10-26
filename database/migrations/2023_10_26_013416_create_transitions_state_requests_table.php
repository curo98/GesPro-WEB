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
        Schema::create('transitions_state_requests', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_supplier_request');
            $table->foreign('id_supplier_request')->references('id')->on('supplier_requests');


            $table->unsignedBigInteger('from_state_id')->nullable();
            $table->foreign('from_state_id')->references('id')->on('state_requests');


            $table->unsignedBigInteger('to_state_id')->nullable();
            $table->foreign('to_state_id')->references('id')->on('state_requests');

            $table->unsignedBigInteger('id_reviewer'); // ID del revisor
            $table->foreign('id_reviewer')->references('id')->on('users'); // Clave foránea hacia la tabla de usuarios


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transitions_state_requests');
    }
};
