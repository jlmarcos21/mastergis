<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //Tabla
    protected $table = 'students';

    //Campos a interactuar
    protected $fillable = [
        'code', 'name', 'lastname', 'sex', 'country_id', 'email', 'phone', 'state', 'date'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function assignments()
    {
        return $this->hasmany(Assignment::class);
    }

    public function sales()
    {
        return $this->hasmany(Sale::class);
    }

}
