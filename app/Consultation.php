<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{

    protected $table = 'consultations';

    protected $fillable = [
        'student_id', 'user_id', 'contact_id', 'course_id', 'interest_id', 'description', 'date', 'change_date', 'reminder_date', 'notification', 'finished'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function interest()
    {
        return $this->belongsTo(Interest::class);
    }

    public function details()
    {
        return $this->hasMany(DetailConsultation::class)->orderBy('date', 'DESC');
    }

}
