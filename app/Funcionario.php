<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = "funcionario";

    public function telefonesFuncionario(){
        return $this->hasMany('App\TelefoneFuncionario');
    }
    public  function contaBancariaFuncionario(){
        return $this->hasOne('App\ContaBancariaFuncionario');
    }
//    public  function folhaSalarialFuncionario(){
//        return $this->hasOne('App\FolhaSalarial');
//    }
    public  function folhaSalarialFuncionario(){
        return $this->hasMany('App\FolhaSalarial');
    }
    public function solicitacoesValeFuncionario(){
        return $this->hasMany('App\SolicitacaoVale');
    }
    public function empresa(){
        return $this->belongsTo('App\Empresa');
    }
    public function user(){
        return $this->hasOne('App\User');
    }
}
