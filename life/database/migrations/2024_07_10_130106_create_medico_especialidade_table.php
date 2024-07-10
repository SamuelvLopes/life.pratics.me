<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('medico_especialidade', function (Blueprint $table) {
            $table->id('me_codigo');
            $table->unsignedBigInteger('med_codigo');
            $table->unsignedBigInteger('espec_codigp');
            $table->foreign('med_codigo')->references('med_codigo')->on('medico')->onDelete('cascade');
            $table->foreign('espec_codigp')->references('espec_codigo')->on('especialidade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medico_especialidade');
    }
};
