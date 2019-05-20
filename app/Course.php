<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'name', 'certificate', 'code', 'level_id', 'duration', 'image_url', 'state'
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function detailsales()
    {
        return $this->hasMany(DetailSale::class);
    }
}
