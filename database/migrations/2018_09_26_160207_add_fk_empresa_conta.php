<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkEmpresaConta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contaBancariaEmpresa', function (Blueprint $table) {
            $table->unsignedInteger('empresa_id');

            $table->foreign('empresa_id')->references('id')->on('empresa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contaBancariaEmpresa', function (Blueprint $table) {
            $table->dropForeign('contabancariaempresa_empresa_id_foreign');
            $table->dropColumn('empresa_id');
        });
    }
}
