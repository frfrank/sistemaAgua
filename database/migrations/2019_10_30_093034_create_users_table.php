<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->foreign('id')->references('id')->on('perfil_usuario');

            $table->string('nombreUsuario')->unique();
            $table->string('password');
            $table->integer('estado');

            $table->unsignedBigInteger('idrol');
            $table->foreign('idrol')->references('id')->on('roles');
            $table->rememberToken();

       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
