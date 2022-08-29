<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->date("fecha");
            $table->string("concepto");
            $table->double("monto", 20);
            $table->text("comentario")->nullable();
//            $table->unsignedBigInteger("idCaja")->nullable();
//            $table->unsignedInteger("idTipo"); //Tipo categoria
//            $table->unsignedInteger("idTipoPago"); //Tipo categoria
//            $table->unsignedInteger("idUsuario");
//            $table->unsignedInteger("idEmpresa");
            $table->foreignId("caja_id")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->foreignId("tipo_id")->type("integer")->constrained();
            $table->foreignId("tipo_id_pago")->type("integer")->constrained();
            $table->foreignId("compania_id")->type("integer")->constrained();
            $table->softDeletes();
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
        Schema::dropIfExists('gastos');
    }
}
