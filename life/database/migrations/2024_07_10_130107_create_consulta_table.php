<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('consulta', function (Blueprint $table) {
            $table->id('cons_codigo');
            $table->dateTime('cons_horario');
            $table->boolean('cons_particular');
            $table->unsignedBigInteger('pac_codigo');
            $table->unsignedBigInteger('med_codigo');
            $table->foreign('pac_codigo')->references('pac_codigo')->on('paciente')->onDelete('cascade');
            $table->foreign('med_codigo')->references('med_codigo')->on('medico')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consulta');
    }
};
