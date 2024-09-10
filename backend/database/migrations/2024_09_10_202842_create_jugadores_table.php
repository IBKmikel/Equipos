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
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apodo', 100);
            $table->string('posicion', 100);
            $table->integer('edad');
            $table->integer('status');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->unsignedBigInteger('equipos_id');
            $table->foreign('equipos_id')->references('id')->on('equipos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadores');
    }
};
