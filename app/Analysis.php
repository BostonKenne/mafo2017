<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    //
    protected $fillable = [
        'type','description',
    ];

    protected $table = 'analyses';

    public function parametres(){
    	return $this->hasMany('\App\Parametre', 'idtype');
    }


}
