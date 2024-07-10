<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('procedimento_especialidade', function (Blueprint $table) {
            $table->id('pe_codigo');
            $table->unsignedBigInteger('proc_codigo');
            $table->unsignedBigInteger('espec_codigo');
            $table->foreign('proc_codigo')->references('proc_codigo')->on('procedimento')->onDelete('cascade');
            $table->foreign('espec_codigo')->references('espec_codigo')->on('especialidade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('procedimento_especialidade');
    }
};
