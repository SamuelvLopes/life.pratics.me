<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('paciente', function (Blueprint $table) {
            $table->id('pac_codigo');
            $table->date('pac_data_nascimento');
            $table->string('pac_nome');
            $table->string('pac_email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('pac_password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paciente');
    }
};
