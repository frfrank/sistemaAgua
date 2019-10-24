<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            
            $table->bigIncrements('id');
           $table->unsignedBigInteger('idcomunidad');
            $table->string('nombre',100);
            $table->string('apellido',100);
            $table->string('tipoDocumento');
            $table->string('cedula',20)->unique();
            $table->integer('edad');
            $table->string('lugarNacimiento')->nullable();
            $table->string('direccion')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('telefono')->nullable();
            $table->integer('estado');
            $table->timestamps();
            $table->foreign('idcomunidad')->references('id')->on('comunidades');
            //hago referencia que esta relacionada con la tabla comunidad
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
