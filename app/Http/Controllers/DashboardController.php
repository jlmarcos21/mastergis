<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Student;
use App\Course;
use App\Country;
use App\Sale;
use App\Consultation;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');        
    }
    
    public function dashboard()
    {
        $students   = Student::where('state', '1')->count();
        $courses    = Course::count();
        $countries  = Country::count();
        $sales      = Sale::where('canceled', '0')->count();
        $consultations      = Consultation::count();
        
        $months = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $date = $months[$month - 1];

        $sales_pe = Sale::whereYear('date', '=', $year)
                    ->whereMonth('date', $month)
                    ->where('currency_id', '=', 1)
                    ->where('canceled', '0')
                    ->selectRaw('sum(total) as total')                    
                    ->first();
                    
        $sales_usd = Sale::whereYear('date', '=', $year)
                    ->whereMonth('date', $month)
                    ->where('currency_id', '=', 2)
                    ->where('canceled', '0')
                    ->selectRaw('sum(total) as total')                    
                    ->first();                    

        return view('dashboard', compact('students', 'courses', 'countries', 'sales', 'consultations', 'date', 'sales_pe', 'sales_usd'));
    }

    public function search_year($year)
    {              
        $months = array(
            ['number' => 1, 'name' => 'Enero'],
            ['number' => 2, 'name' => 'Febrero'],
            ['number' => 3, 'name' => 'Marzo'],
            ['number' => 4, 'name' => 'Abril'],
            ['number' => 5, 'name' => 'Mayo'],
            ['number' => 6, 'name' => 'Junio'],
            ['number' => 7, 'name' => 'Julio'],
            ['number' => 8, 'name' => 'Agosto'],
            ['number' => 9, 'name' => 'Septiembre'],
            ['number' => 10, 'name' => 'Octubre'],
            ['number' => 11, 'name' => 'Noviembre'],
            ['number' => 12, 'name' => 'Diciembre']
        );

        $chart = array();

        foreach ($months as $month) {
            $total = Sale::whereYear('date', '=', $year)
            ->whereMonth('date', '=', $month['number'])   
            ->where('canceled', '0')         
            ->selectRaw('sum(total) as total')                    
            ->first();

            $sales_soles = Sale::whereYear('date', '=', $year)
            ->whereMonth('date', '=', $month['number'])
            ->where('currency_id', '1')
            ->where('canceled', '0')
            ->selectRaw('sum(total) as total')                    
            ->first();

            $sales_dolares = Sale::whereYear('date', '=', $year)
            ->whereMonth('date', '=', $month['number'])
            ->where('currency_id', '2')
            ->where('canceled', '0')
            ->selectRaw('sum(total) as total')                    
            ->first();

            array_push($chart, [
                'mes' => $month['name'],
                'total' => floatval($total->total),
                'total_soles' => floatval($sales_soles->total),
                'total_dolares' => floatval($sales_dolares->total),
            ]);            
        }        

        return $chart;        
    }
    
}
