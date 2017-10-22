<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoordonneesSite extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array


     */
    protected $table = 'coordonnees_sites';


    protected $fillable = [
        'lat',
        'lng',
        'idsite',
        'alt'
    ];


    public function site(){
        return $this->belongsTo('\App\Site', 'idsite');
    }
}
