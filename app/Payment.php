<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'sale_id', 'description', 'previous_amount', 'amount', 'next_amount', 'date'
    ];
}
