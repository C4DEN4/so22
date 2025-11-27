<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();

           
            $table->string('personas_cedula');
            $table->foreign('personas_cedula')
                  ->references('cedula')->on('personas')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

           
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')
                  ->references('id')->on('areas')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->text('observaciones')->nullable();
            $table->enum('estado', ['ingreso', 'terminado'])->default('ingreso');

            $table->timestamps();

            $table->index(['personas_cedula', 'area_id', 'estado']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('ingresos');
    }
};
