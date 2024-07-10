<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('consulta_procedimento', function (Blueprint $table) {
            $table->id('cp_codigo');
            $table->unsignedBigInteger('proc_codigo');
            $table->unsignedBigInteger('cons_codigo');
            $table->foreign('proc_codigo')->references('proc_codigo')->on('procedimento')->onDelete('cascade');
            $table->foreign('cons_codigo')->references('cons_codigo')->on('consulta')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consulta_procedimento');
    }
};
