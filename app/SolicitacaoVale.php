<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitacaoVale extends Model
{
    protected $table = "solicitacaoVale";

    public function empresa(){
        return $this->belongsTo('App\Empresa');
    }
    public function funcionario(){
        return $this->belongsTo('App\Funcionario');
    }
    public function statusVale(){
        return $this->belongsTo('App\StatusVale');
    }
}
