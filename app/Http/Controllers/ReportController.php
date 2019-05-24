<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\SearchSaleDataTable;
use App\DataTables\SerchAssignmentsDataTable;
use App\Sale;
use App\PaymentM;
use App\Voucher;
use App\Currency;

use App\DetailSale;

use App\Assignment;
use App\Course;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search_sales(Request $request)
    { 
        auth()->user()->authorizeRoles(['admin', 'accounting']);

        $payments = PaymentM::all();
        $vouchers = Voucher::all();
        $currencies = Currency::all();

        if(isset($request->date_s) && isset($request->date_f)) {
            $sales = Sale::orderBy('id', 'DESC')
                        ->voucher($request->searchvoucher)
                        ->payment($request->searchpayment)
                        ->currency($request->searchcurrency)
                        ->whereBetween('date', [$request->date_s, $request->date_f])
                        ->get();

            return view('reports.sales_consultation', compact('payments', 'vouchers', 'currencies', 'request', 'sales'));
        }else {
            return view('reports.sales_consultation', compact('payments', 'vouchers', 'currencies', 'request'));
        }            
    }

    public function search_courses(Request $request)
    {        
        auth()->user()->authorizeRoles(['admin', 'accounting']);
        
        if(isset($request->date_s) && isset($request->date_f)) {
            $s_courses = DetailSale::orderBy('date', 'DESC')
                        ->whereBetween('date', [$request->date_s, $request->date_f])                                     
                        ->get();

            return view('reports.courses_consultation', compact('s_courses', 'request'));                 
        }else {
            return view('reports.courses_consultation', compact('request'));
        }                
    }

    public function search_assignments(Request $request)
    {
        auth()->user()->authorizeRoles(['admin', 'accounting']);

        $courses = Course::all();            

        if(isset($request->date_s) && isset($request->date_f)) {
            $s_assignments = Assignment::orderBy('id', 'DESC')                            
                            ->course($request->searchcourse)
                            ->access($request->searchaccess)
                            ->entry($request->searchentry)
                            ->basic($request->searchbasisc)
                            ->intermediate($request->searchintermediate)
                            ->advanced($request->searchadvanced)
                            ->finished($request->searchfinished)
                            ->whereBetween('start_date', [$request->date_s, $request->date_f])
                            ->get();

            return view('reports.assignments_consultation', compact('courses', 's_assignments', 'request'));                 
        }else {
            return view('reports.assignments_consultation', compact('courses', 'request'));
        }        
    }    

}
