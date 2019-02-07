<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkEmpresaEFuncionarioSolicitacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacaoVale', function (Blueprint $table) {
            $table->unsignedInteger('funcionario_id')->nullable(true);
            $table->unsignedInteger('empresa_id')->nullable(true);

            $table->foreign('funcionario_id')->references('id')->on('funcionario')->onDelete('set null');
            $table->foreign('empresa_id')->references('id')->on('empresa')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitacaoVale', function (Blueprint $table) {
            $table->dropForeign('solicitacaovale_funcionario_id_foreign');
            $table->dropForeign('solicitacaovale_empresa_id_foreign');
            $table->dropColumn('funcionario_id');
            $table->dropColumn('empresa_id');
        });
    }
}
