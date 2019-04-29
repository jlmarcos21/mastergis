<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentM extends Model
{
    protected $table = 'payment_ms';

    protected $fillable = [
        'name', 'icon'
    ];
}
