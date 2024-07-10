<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('medico', function (Blueprint $table) {
            $table->id('med_codigo');
            $table->string('med_crm');
            $table->string('med_nome');
            $table->string('med_email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('med_password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medico');
    }
};
