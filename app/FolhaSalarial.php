<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FolhaSalarial extends Model
{
    protected $table = "folhaSalarial";

    public function funcionario(){
        return $this->belongsTo('App\Funcionario');
    }
}
