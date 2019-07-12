<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignments';

    protected $fillable = [
        'code', 'sale_id', 'student_id', 'course_id', 'description_sale', 'description', 'access', 'entry', 'basic_constancy', 'intermediate_constancy', 'advanced_constancy', 'certificate', 'finished', 'poll', 'physical_certificate', 'date', 'start_date', 'final_date', 'remaining_days'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

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
        if($access != '')
            return $query->where('access', $access);        
    }

    public function scopeEntry($query, $entry)
    {
        if($entry != '')
            return $query->where('entry', $entry);        
    }

    public function scopeBasic($query, $basic)
    {
        if($basic != '')
            return $query->where('basic_constancy', $basic);        
    }

    public function scopeIntermediate($query, $intermediate)
    {
        if($intermediate != '')
            return $query->where('intermediate_constancy', $intermediate);
    }

    public function scopeAdvanced($query, $advanced)
    {
        if($advanced != '')
            return $query->where('advanced_constancy', $advanced);
    }

    public function scopeFinished($query, $finished)
    {
        if($finished != '')
            return $query->where('finished', $finished);
    } 

}
