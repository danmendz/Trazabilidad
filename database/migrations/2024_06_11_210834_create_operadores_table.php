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
        Schema::create('operadores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 30);
            $table->bigInteger('id_area')->nullable()->unsigned();
            $table->foreign('id_area')->references('id')->on('areas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operadores');
    }
};