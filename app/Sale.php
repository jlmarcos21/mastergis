<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'code', 'serie', 'user_id', 'student_id', 'voucher_id', 'payment_id', 'agency_id', 'currency_id', 'description', 'date', 'time', 'credit', 'subtotal', 'debt', 'total', 'discount_paypal', 'total_paypal', 'discount_interbank', 'total_interbank', 'canceled'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function payment()
    {
        return $this->belongsTo(PaymentM::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
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

    public function scopeVoucher($query, $voucher)
    {
        if($voucher != '')
            return $query->where('voucher_id', 'LIKE', "%$voucher%");
    }

    public function scopePayment($query, $payment)
    {
        if($payment != '')
            return $query->where('payment_id', 'LIKE', "%$payment%");
    }

    public function scopeCurrency($query, $currency)
    {
        if($currency != '')
            return $query->where('currency_id', 'LIKE', "%$currency%");
    }

    public function scopeCredit($query, $credit)
    {
        if($credit != '')
            return $query->where('credit', 'LIKE', "%$credit%");
    }

    public function scopeCanceled($query, $canceled)
    {
        if($canceled != '')
            return $query->where('canceled', 'LIKE', "%$canceled%");
    }
    
}
