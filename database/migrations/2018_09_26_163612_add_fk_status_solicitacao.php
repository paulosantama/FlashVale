<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkStatusSolicitacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacaoVale', function (Blueprint $table) {
            $table->unsignedInteger('status_vale_id')->nullable(true);

            $table->foreign('status_vale_id')->references('id')->on('statusVale')->onDelete('set null');
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
            $table->dropForeign('solicitacaovale_status_vale_id_foreign');
            $table->dropColumn('status_vale_id');
        });
    }
}
