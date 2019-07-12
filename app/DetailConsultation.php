<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailConsultation extends Model
{
    protected $table = 'detail_consultations';

    protected $fillable = [
        'consultation_id', 'user_id', 'contact_id', 'interest_id', 'description', 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function interest()
    {
        return $this->belongsTo(Interest::class);
    }
}
