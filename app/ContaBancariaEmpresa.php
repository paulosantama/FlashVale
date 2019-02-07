<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContaBancariaEmpresa extends Model
{
    protected $table = "contaBancariaEmpresa";

    public function empresa(){
        return $this->belongsTo('App\Empresa');
    }
}
