<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    //Tabla
    protected $table = 'countries';
    
    //Campos a interactuar
    protected $fillable = [
        'description', 'flag'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

}
