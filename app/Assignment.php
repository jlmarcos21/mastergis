<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignments';

    protected $fillable = [
        'code', 'student_id', 'course_id', 'access', 'entry', 'basic_constancy', 'intermediate_constancy', 'advanced_constancy', 'certificate', 'finished', 'poll', 'physical_certificate', 'start_date', 'final_date', 'remaining_days'
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
    public function scopeCourse($query, $course)
    {
        if($course)
            return $query->where('course_id', 'LIKE', "%$course%");        
    }

    public function scopeAccess($query, $access)
    {
        if($access)
            return $query->where('access', 'LIKE', "%$access%");        
    }

    public function scopeEntry($query, $entry)
    {
        if($entry)
            return $query->where('entry', 'LIKE', "%$entry%");        
    }

    public function scopeBasic($query, $basic)
    {
        if($basic)
            return $query->where('basic_constancy', 'LIKE', "%$basic%");        
    }

    public function scopeIntermediate($query, $intermediate)
    {
        if($intermediate)
            return $query->where('intermediate_constancy', 'LIKE', "%$intermediate%");
    }

    public function scopeAdvanced($query, $advanced)
    {
        if($advanced)
            return $query->where('advanced_constancy', 'LIKE', "%$advanced%");
    }

    public function scopeFinished($query, $finished)
    {
        if($finished)
            return $query->where('finished', 'LIKE', "%$finished%");
    } 

}
