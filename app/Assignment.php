<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignments';

    protected $fillable = [
        'code', 'student_id', 'course_id', 'access', 'entry', 'physical_certificate', 'poll', 'start_date', 'final_date'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

}
