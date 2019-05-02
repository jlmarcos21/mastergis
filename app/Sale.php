<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'code', 'student_id', 'payment_id', 'currency_id', 'description', 'date', 'time', 'credit', 'subtotal', 'debt', 'total'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function payment()
    {
        return $this->belongsTo(PaymentM::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function items()
    {
        return $this->hasMany(DetailSale::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->orderBy('created_at', 'DESC');
    }
}
