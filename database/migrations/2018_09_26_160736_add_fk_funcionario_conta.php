<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkFuncionarioConta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contaBancariaFuncionario', function (Blueprint $table) {
            $table->unsignedInteger('funcionario_id');

            $table->foreign('funcionario_id')->references('id')->on('funcionario')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contaBancariaFuncionario', function (Blueprint $table) {
            $table->dropForeign('contabancariafuncionario_funcionario_id_foreign');
            $table->dropColumn('funcionario_id');
        });
    }
}
