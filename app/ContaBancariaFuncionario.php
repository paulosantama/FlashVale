<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContaBancariaFuncionario extends Model
{
    protected $table = "contaBancariaFuncionario";

    public function funcionario(){
        return $this->belongsTo('App\Funcionario');
    }
}
