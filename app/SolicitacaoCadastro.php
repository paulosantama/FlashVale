<?php

namespace App;

use http\Url;
use Illuminate\Database\Eloquent\Model;

class SolicitacaoCadastro extends Model
{
    protected $table = "solicitacaoCadastro";

    public function empresa(){
        return $this->belongsTo('App\Empresa');
    }
    public function funcionario(){
        return $this->belongsTo('App\Funcionario');
    }

    public function aprovar(){
        $this->funcionario->ativo = true;
        $this->funcionario->save();
        $this->delete();
    }
    public function reprovar(){
        $this->funcionario->ativo = false;
//        $this->funcionario->save();
        $this->funcionario->delete();
    }
}
