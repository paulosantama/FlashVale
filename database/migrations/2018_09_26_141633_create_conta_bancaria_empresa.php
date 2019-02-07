<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContaBancariaEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contaBancariaEmpresa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banco');
            $table->string('agencia');
            $table->string('numero_conta');
            $table->string('variacao_conta');
            $table->string('descricao')->nullable(true);
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
        Schema::dropIfExists('contaBancariaEmpresa');
    }
}
