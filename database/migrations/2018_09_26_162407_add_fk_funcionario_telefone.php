<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkFuncionarioTelefone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('telefoneFuncionario', function (Blueprint $table) {
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
        Schema::table('telefoneFuncionario', function (Blueprint $table) {
            $table->dropForeign('telefonefuncionario_funcionario_id_foreign');
            $table->dropColumn('funcionario_id');
        });
    }
}
