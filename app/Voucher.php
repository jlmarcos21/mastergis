<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'vouchers';

    protected $fillable = [
        'name', 'serie'
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
