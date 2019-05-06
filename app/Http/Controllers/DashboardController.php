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
        
        $months = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $month = Carbon::now()->month;
        $date = $months[$month - 1];

        $sales_pe = Sale::whereMonth('date', $month)
                    ->where('currency_id', '=', 1)
                    ->selectRaw('sum(total) as total')                    
                    ->first();
                    
        $sales_usd = Sale::whereMonth('date', $month)
                    ->where('currency_id', '=', 2)
                    ->selectRaw('sum(total) as total')                    
                    ->first();                    

        return view('dashboard', compact('students', 'courses', 'countries', 'sales', 'date', 'sales_pe', 'sales_usd'));
    }
    
}
