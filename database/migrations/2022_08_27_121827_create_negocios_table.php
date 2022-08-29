<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocios', function (Blueprint $table) {
            $table->id();
            $table->string("nombre")->nullable();
            $table->string("tipo")->nullable();
            $table->string("tiempoExistencia")->nullable();
//            $table->unsignedInteger("idDireccion")->nullable();
//            $table->unsignedInteger("idMoneda");
//            $table->unsignedInteger("idNacionalidad");
            // $table->unsignedInteger("idContacto");
            // $table->unsignedInteger("idCliente");

//            $table->foreign("idDireccion")->references("id")->on("addresses");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negocios');
    }
}
