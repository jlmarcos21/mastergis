<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'assignment_id', 'user_id', 'sub_level_id', 'description', 'state', 'date'
    ];

    public function user()
    {
        return $his->belogsTo(User::class);
    }

    public function sub_level()
    {
        return $this->belongsTo(SubLevel::class);
    }
}
