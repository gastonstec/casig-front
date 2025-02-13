<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tecnicos', function (Blueprint $table) {
            $table->id(); // Id autoincremental
            $table->string('correo')->unique(); // Correo del técnico
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tecnicos');
    }
};
