<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelefoneFuncionario extends Model
{
    protected $table = "telefoneFuncionario";

    protected $fillable = [
        'numero',
        'descricao'
    ];

    public function funcionario(){
        return $this->belongsTo('App\Funcionario');
    }
}
