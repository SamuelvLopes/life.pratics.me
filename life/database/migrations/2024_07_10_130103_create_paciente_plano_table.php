<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('paciente_plano', function (Blueprint $table) {
            $table->id('pp_codigo');
            $table->unsignedBigInteger('pac_codigo');
            $table->unsignedBigInteger('plano_codigo');
            $table->string('nr_contrato');
            $table->foreign('pac_codigo')->references('pac_codigo')->on('paciente')->onDelete('cascade');
            $table->foreign('plano_codigo')->references('plano_codigo')->on('plano_saude')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paciente_plano');
    }
};
