<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusVale extends Model
{
    protected $table = "statusVale";
    protected $fillable = ['id','descricao'];

    public function solicitacoes(){
        return $this->hasMany('App\SolicitacaoVale');
    }
}
