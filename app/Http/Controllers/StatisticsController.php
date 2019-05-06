<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;
use App\Student;
Use App\Country;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $courses = Course::withCount(['assignments'])->orderBy('assignments_count', 'DESC')->take(5)->get();

        $students = Student::withCount(['sales'])->orderBy('sales_count','DESC')->take(10)->get();

        $students_courses = Student::withCount(['assignments'])->orderBy('assignments_count','DESC')->take(10)->get();
        
        $countries = Country::withCount(['students'])->orderBy('students_count', 'DESC')->take(10)->get();
                
        return view('statistics.index', compact('courses', 'students', 'students_courses', 'countries'));
    }
}
