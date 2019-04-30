<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Student;
use App\Course;
use App\Country;
use App\Sale;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');        
    }
    
    public function dashboard()
    {
        $students   = Student::count();
        $courses    = Course::count();
        $countries  = Country::count();
        $sales      = Sale::count();

        return view('dashboard', compact('students', 'courses', 'countries', 'sales'));
    }
    
}
