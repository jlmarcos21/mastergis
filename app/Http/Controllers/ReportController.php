<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sale;
use App\DetailSale;

class ReportController extends Controller
{

    public function search_sales(Request $request)
    {           
        if(isset($request->date_s) && isset($request->date_f)) {
            $sales = Sale::orderBy('id', 'DESC')
                        ->whereBetween('date', [$request->date_s, $request->date_f])
                        ->get();

            return view('reports.sales_consultation', compact('sales', 'request'));
        }else {
            return view('reports.sales_consultation', compact('request'));
        }            
    }

    public function search_courses(Request $request)
    {        
        if(isset($request->date_s) && isset($request->date_f)) {
            $s_courses = DetailSale::orderBy('date', 'DESC')
                        ->whereBetween('date', [$request->date_s, $request->date_f])                                     
                        ->get();

            return view('reports.courses_consultation', compact('request'));                 
        }else {
            return view('reports.courses_consultation', compact('s_courses', 'request'));
        }                
    }

}
