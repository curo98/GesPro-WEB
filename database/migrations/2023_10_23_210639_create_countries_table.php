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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('iso_alpha2');
            $table->string('iso_alpha3');
            $table->unsignedInteger('iso_numeric'); // Change to unsigned integer
            $table->string('currency_code');
            $table->string('currency_name');
            $table->string('currency_symbol');
            $table->string('flag'); // Assuming 'flag' is a file path or URL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paises');
    }
};
