<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    //
    protected $fillable = [
        'nom','idtype',
    ];

    protected $table = 'parametres';



    public function analyse(){
    	return $this->belonsTo('\App\Analysis', 'idtype'); 
    }
}
