<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Echantillon extends Model
{
    //
     use SoftDeletes;

     protected $dates = ['deleted_at'];

     protected $table = 'echantillons';


    protected $fillable = [
        'code',
        'pfd_debut',
        'pfd_fin',
        'date_prelevement',
        'autre_info',
        'couleur',
        'structure',
        'texture',
        'idpuit'
    ];


    public function puit(){
        return $this->belongsTo('\App\Puit', 'idpuit','id');
    }

    

    
}
