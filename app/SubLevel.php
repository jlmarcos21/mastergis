<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubLevel extends Model
{
    protected $table = 'sub_levels';

    protected $fillable = [
        'description', 'colour'
    ];

}
