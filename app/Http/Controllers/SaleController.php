<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\SalesDataTable;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Student;
use App\Course;
use App\PaymentM;
use App\Voucher;

use App\Sale;
use App\DetailSale;
use App\Assignment;
use App\Currency;

class SaleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(SalesDataTable $dataTable)
    {
        return $dataTable->render('sales.index');
    }

    public function create()
    {
        return view('sales.create');
    }

    public function show($id)
    {
        $sale = Sale::findOrFail($id);        
        return view('sales.show', compact('sale'));
    }

    public function getData()
    {
        $students = Student::orderBy('id', 'DESc')
                    ->where('state', '=', '1')
                    ->with('country')
                    ->with('assignments')
                    ->get();
        
        $courses = Course::orderBy('name', 'ASC')
                    ->where('state', '=', '1')
                    ->get();
                    
        $paymentms = PaymentM::all();
        $currencies = Currency::all();
        $vouchers = Voucher::all();
        
        return response()->json([
            'students'      => $students,
            'courses'       => $courses,
            'paymentms'     => $paymentms,
            'currencies'    => $currencies,
            'vouchers'      => $vouchers,
        ], 200);
    }

    public function VerificarCourse($student_id, $course_id)
    {
        $student_courses = Assignment::where('student_id', '=', $student_id)
                            ->where('course_id', '=', $course_id)->first();

        return response()->json($student_courses, 200);
    }

    public function SaveSale(Request $request)
    {
       try {
            
            $date_now = Carbon::now()->toDateString();
            
            //Registrar Venta
            $sale = new Sale();

            $serie = Voucher::where('id', '=', $request->voucher_id)->first();

            $code = $serie->serie."-".str_pad(($sale->where('voucher_id', '=', $request->voucher_id)->count() + 1), 6, "0", STR_PAD_LEFT);

            $sale->code = $code;
            $sale->serie = str_pad(($sale->where('voucher_id', '=', $request->voucher_id)->count() + 1), 6, "0", STR_PAD_LEFT);
            $sale->user_id = auth()->user()->id;
            $sale->student_id = $request->student_id;
            $sale->payment_id = $request->payment_id;
            $sale->voucher_id = $request->voucher_id;
            $sale->currency_id = $request->currency_id;
            $sale->description = $request->description;
            $sale->date = $date_now;
            $sale->time = Carbon::now()->toTimeString();
            $sale->credit = $request->credit;
            $sale->subtotal = $request->subtotal;

            if ($sale->credit==1) {
                $sale->debt = $request->total;
            }else{
                $sale->debt = 0.0;
            }

            $sale->total = $request->total;

            if($request->payment_id==2){

                // calcular el descuento por paypal 
                $totpaypal = number_format(((($request->total * 94.6) / 100) - 0.3), 2);
                $discpaypal = number_format(($request->total - $totpaypal), 2);

                $sale->discount_paypal = $discpaypal;
                $sale->total_paypal = $totpaypal;

                // calcular el descuento por interbank
                $totinterbank = number_format(((($totpaypal * 98.5) / 100)), 2);
                $discinterbank = number_format(($totpaypal - $totinterbank), 2);

                $sale->discount_interbank = $discinterbank;
                $sale->total_interbank = $totinterbank;

            }else{
                $sale->discount_paypal = 0.0;
                $sale->total_paypal = $request->total;

                $sale->discount_interbank = 0.0;
                $sale->total_interbank = $request->total;
            }

            
            $sale->save();

            foreach ($request->courses as $course) {

                //Registrar Detalle de la venta
                $item = new DetailSale();                
                $item->sale_id = $sale->id;
                $item->course_id = $course['course_id'];
                $item->course_description = $course['course_description'];
                $item->price = $course['course_price'];
                $item->quantity = $course['course_quantity'];
                $item->total = $course['course_total'];
                $item->date = $date_now;
                $item->save();

                //Asiganaciones
                $item = new Assignment();
                $codea = str_pad(($course['course_code']).(($item->orderBy('id', 'DESC')->pluck('id')->first() + 1)), 10, "0", STR_PAD_LEFT);          
                $item->code = str_slug($codea);
                $item->student_id = $request->student_id;
                $item->course_id = $course['course_id'];
                $item->access = false;
                $item->entry = false;
                $item->poll = false;
                $item->physical_certificate = false;
                $item->start_date = $date_now;
                $item->final_date = Carbon::now()->addYear(1)->toDateString();

                $item->save();
            }            

            return response()->json($sale->id, 200);

       } catch (Throwable $errror) {
            return response()->json($errror, 500);
       }
    }

    public function create_pdf($code)
    {
        $sale = Sale::where('code' ,'=', $code)->first();
        
        $pdf = PDF::loadView('pdf.sale2', compact('sale'));
                
        return $pdf->download('venta_'.$sale->code.'.pdf');

    }
    
}
