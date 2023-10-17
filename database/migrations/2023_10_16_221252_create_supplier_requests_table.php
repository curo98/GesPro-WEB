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
        Schema::create('supplier_requests', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');

            $table->unsignedBigInteger('id_state');
            $table->foreign('id_state')->references('id')->on('state_requests');

            $table->unsignedBigInteger('id_type_payment');
            $table->foreign('id_type_payment')->references('id')->on('type_payments');

            $table->unsignedBigInteger('id_method_payment');
            $table->foreign('id_method_payment')->references('id')->on('method_payments');

            $table->timestamps();
        });




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_requests');
    }
};
