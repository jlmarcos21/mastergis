<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSale extends Model
{
    protected $table = 'detail_sales';

    protected $fillable = [
        'sale_id', 'course_id', 'course_description', 'price', 'quantity', 'total', 'date'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
