<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //Tabla
    protected $table = 'provinces';
    
    //Campos a interactuar
    protected $fillable = [
        'description'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class)->where('state', '1');
    }
}
