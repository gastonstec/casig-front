<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->id(); // Id de Dispositivo autoincremental
            $table->string('numero_serie')->unique(); // Número de serie del dispositivo
            $table->string('categoria'); // Categoría del dispositivo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dispositivos');
    }
};
