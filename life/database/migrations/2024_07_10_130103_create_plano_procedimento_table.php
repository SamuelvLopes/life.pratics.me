<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('plano_procedimento', function (Blueprint $table) {
            $table->id('pproc_codigo');
            $table->unsignedBigInteger('plano_codigo');
            $table->unsignedBigInteger('proc_codigo');
            $table->foreign('plano_codigo')->references('plano_codigo')->on('plano_saude')->onDelete('cascade');
            $table->foreign('proc_codigo')->references('proc_codigo')->on('procedimento')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plano_procedimento');
    }
};
