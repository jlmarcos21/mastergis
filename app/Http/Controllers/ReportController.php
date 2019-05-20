<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\SearchSaleDataTable;
use App\Sale;
use App\PaymentM;
use App\Voucher;
use App\Currency;

use App\DetailSale;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search_sales(Request $request)
    { 
        
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

    public function search_sales2(SearchSaleDataTable $dataTable, Request $request)
    {
        $payments = PaymentM::all();
        $vouchers = Voucher::all();
        $currencies = Currency::all();

        if(isset($request->date_s) && isset($request->date_f)) {
            return $dataTable->with([
                'searchvoucher'     => $request->searchvoucher,
                'searchpayment'     => $request->searchpayment,
                'searchcurrency'    => $request->searchcurrency,
                'date_s'            => $request->date_s,
                'date_f'            => $request->date_f,
            ])->render('reports.sales_consultation2', compact('payments', 'vouchers', 'currencies', 'request'));
        }else {
            return $dataTable->with([
                'searchvoucher'     => $request->searchvoucher,
                'searchpayment'     => $request->searchpayment,
                'searchcurrency'    => $request->searchcurrency,
                'date_s'            => $request->date_s,
                'date_f'            => $request->date_f,
            ])->render('reports.sales_consultation2', compact('payments', 'vouchers', 'currencies', 'request'));
        } 
        
    }

    public function search_courses(Request $request)
    {        
        if(isset($request->date_s) && isset($request->date_f)) {
            $s_courses = DetailSale::orderBy('date', 'DESC')
                        ->whereBetween('date', [$request->date_s, $request->date_f])                                     
                        ->get();

            return view('reports.courses_consultation', compact('s_courses', 'request'));                 
        }else {
            return view('reports.courses_consultation', compact('request'));
        }                
    }

}
