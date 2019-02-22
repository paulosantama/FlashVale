<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkFolhaSolicitacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacaoVale', function (Blueprint $table) {
            $table->unsignedInteger('folha_id')->nullable(true);

            $table->foreign('folha_id')->references('id')->on('folhasalarial')->onDelete('set null');
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
            $table->dropForeign('solicitacaovale_folha_id_foreign');
            $table->dropColumn('folha_id');
        });
    }
}
