<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    //
    protected $fillable = [
        'nom','description',
    ];

    protected $table = 'sites';


    public function puits(){
    	return $this->hasMany('\App\Puit', 'idsite','id');
    }

    public function coordonnees(){
    	return $this->hasMany('\App\CoordonneesSite', 'idsite');
    }
}
