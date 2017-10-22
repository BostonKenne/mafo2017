<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puit extends Model
{
    //
    protected $fillable = [
        'lat','lng', 'alt', 'idsite','code',
    ];

    public function echantillons(){
    	return $this->hasMany('\App\Echantillon', 'idpuit', 'id');
    }

    public function site(){
    	return $this->belongsTo('\App\Site', 'idsite','id');
    }



}
