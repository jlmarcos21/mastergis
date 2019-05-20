<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignments';

    protected $fillable = [
        'code', 'student_id', 'course_id', 'access', 'entry', 'physical_certificate', 'poll', 'finished', 'start_date', 'final_date', 'remaining_days'
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

    //Filtros
    public function scopeEntry($query, $entry)
    {
        if($entry)
            return $query->where('entry', '=', "$entry");
        else
            return $query->where('entry', '=', "0");
    }

    public function scopePoll($query, $poll)
    {
        if($poll)
            return $query->where('poll', '=', "$poll");        
        else
            return $query->where('poll', '=', "0");
    }

    public function scopeFinished($query, $finished)
    {
        if($finished)
            return $query->where('finished', '=', "$finished");
        else
            return $query->where('finished', '=', "0");
    }
    

}
