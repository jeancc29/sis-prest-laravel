<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

//            $table->string('photo')->nullable();
            $table->string('usuario')->nullable();
//            $table->string('name')->nullable();
//            $table->string('last_name')->nullable();
            $table->integer('estado')->default(1);
            $table->unsignedInteger('compania_id');
            $table->unsignedInteger('rol_id');
            $table->unsignedInteger('sucursal_id')->nullable();
//            $table->unsignedInteger('contact_id');
            $table->unsignedInteger('ruta_id')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
