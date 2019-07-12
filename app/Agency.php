<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'agencies';

    protected $fillables = [
        'payment_m_id', 'name', 'icon'
    ];

    public function payment()
    {
        return $this->belongsTo(PaymentM::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
