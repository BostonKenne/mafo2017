<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratoire extends Model
{
    //
    protected $fillable = [
        'nom',
        'ville',
        'lng',
        'lat'
    ];

    
}
