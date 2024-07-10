<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('relaciona_telefone', function (Blueprint $table) {
            $table->id('rt_codigo');
            $table->string('rt_descricao');
            $table->unsignedBigInteger('pac_codigo')->nullable();
            $table->unsignedBigInteger('plano_codigo')->nullable();
            $table->unsignedBigInteger('med_codigo')->nullable();
            $table->unsignedBigInteger('t_codigo');
            $table->foreign('t_codigo')->references('t_codigo')->on('telefone')->onDelete('cascade');
            $table->foreign('pac_codigo')->references('pac_codigo')->on('paciente')->onDelete('cascade');
            $table->foreign('med_codigo')->references('med_codigo')->on('medico')->onDelete('cascade');
            $table->foreign('plano_codigo')->references('plano_codigo')->on('plano_saude')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('relaciona_telefone');
    }
};
