<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelefoneEmpresa extends Model
{
    protected $table = "telefoneEmpresa";

    protected $fillable = [
        'numero',
        'descricao'
    ];

    public function empresa(){
        return $this->belongsTo('App\Empresa');
    }
}
