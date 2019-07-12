<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $table = 'interests';

    protected $fillable = [
        'name', 'colour', 'stars'
    ];

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }
}
