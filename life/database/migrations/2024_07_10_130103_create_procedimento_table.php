<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('procedimento', function (Blueprint $table) {
            $table->id('proc_codigo');
            $table->string('proc_nome');
            $table->decimal('proc_valor', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('procedimento');
    }
};
