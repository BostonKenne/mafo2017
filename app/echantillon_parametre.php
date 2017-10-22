<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class echantillon_parametre extends Model
{
    //
	protected $fillable = [
        'valeur',
        'echantillon_id',
        'parametre_id',
        'laboratoire_id',
        'image_id'
    ];

    public function images()
    {
    	$this->hasMany(Images::class);
    }

    public function echantillons()
    {
    	$this->hasMany(Echantillons::class);
    }

    public function parametres()
    {
    	$this->hasMany(Parametres::class);
    }

    public function laboratoire()
    {
    	$this->hasMany(Labaratoires::class);
    }
}
