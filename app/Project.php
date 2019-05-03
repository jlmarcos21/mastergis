<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'assignment_id', 'sub_level_id', 'description', 'name', 'state', 'date'
    ];

    public function sub_level()
    {
        return $this->belongsTo(SubLevel::class);
    }
}
