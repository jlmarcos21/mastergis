<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //Tabla
    protected $table = 'students';

    //Campos a interactuar
    protected $fillable = [
        'code', 'name', 'lastname', 'sex', 'country_id', 'province_id', 'email', 'phone', 'state'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function assignments()
    {
        return $this->hasmany(Assignment::class)                    
                    ->orderBy('start_date', 'DESC');
    }

    public function sales()
    {
        return $this->hasmany(Sale::class)
                    ->where('canceled', '0')             
                    ->orderBy('date', 'DESC');
    }

    public function consultations()
    {
        return $this->hasmany(Consultation::class);
    }

}
