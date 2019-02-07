<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertStatusVale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('statusVale', function (Blueprint $table) {

            $status = array(
                new \App\StatusVale(array('id'=>1,'descricao'=>'Em Análise')),
                new \App\StatusVale(array('id'=>2,'descricao'=>'Aprovado')),
                new \App\StatusVale(array('id'=>3,'descricao'=>'Reprovado'))
            );
            foreach ($status as $sta) {
                $sta->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('statusVale', function (Blueprint $table) {
            DB::table('statusVale')->delete();
        });
    }
}
