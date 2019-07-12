<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\SalesDataTable;
use Barryvdh\DomPDF\Facade as PDF;

use DB;

use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Http\Requests\SaleRequest;

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
        auth()->user()->authorizeRoles(['admin', 'marketing', 'accounting']);
        return view('sales.create');
    }

    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->canceled = 1;
        $sale->save();


        $assignments = Assignment::where('sale_id', $id)->get();

        foreach ($assignments as $assignment) {
            $assignment->projects()->delete();
        }

        Assignment::where('sale_id', $id)->delete();


        return redirect()->route('sales.index')->with('info', 'Venta N°'.$sale->code.' Anulada <br> Se Eliminaron Asignaciones');
    }

    public function get_students(Request $request)
    {
        $students = array();

        if($request->name)
        {
            $students = Student::orderBy('id', 'DESC')
                ->with('country')
                ->with('assignments')
                ->orWhereRaw("concat(name, ' ', lastname) LIKE '%".$request->name."%'")
                ->orWhere('code', 'LIKE', "%$request->name%")
                ->orWhere('email', 'LIKE', "%$request->name%")
                ->where('state', '=', '1')
                ->take(10)->get();
        }

        return response()->json($students ,200);
    }

    public function getData()
    {
        $courses = Course::orderBy('name', 'ASC')
                    ->where('state', '=', '1')
                    ->get();

        $paymentms = PaymentM::with('agencies')->get();
        $currencies = Currency::all();
        $vouchers = Voucher::all();

        return response()->json([
            'courses'       => $courses,
            'paymentms'     => $paymentms,
            'currencies'    => $currencies,
            'vouchers'      => $vouchers,
        ], 200);
    }

    public function SaveSale(SaleRequest $request)
    {
        auth()->user()->authorizeRoles(['admin', 'marketing', 'accounting']);


        try {

            DB::beginTransaction();
            // $date_now = Carbon::now()->toDateString();
            $date_now = $request->date;

            //Registrar Venta
            $sale = new Sale();

            $serie = Voucher::where('id', '=', $request->voucher_id)->first();

            $code = $serie->serie."-".str_pad(($sale->where('voucher_id', '=', $request->voucher_id)->count() + 1), 6, "0", STR_PAD_LEFT);

            $sale->code = $code;
            $sale->serie = str_pad(($sale->where('voucher_id', '=', $request->voucher_id)->count() + 1), 6, "0", STR_PAD_LEFT);
            $sale->user_id = auth()->user()->id;
            $sale->student_id = $request->student_id;
            $sale->voucher_id = $request->voucher_id;
            $sale->payment_id = $request->payment_id;
            if($request->agency_id)
                $sale->agency_id = $request->agency_id;
            else
                $sale->agency_id = '1';
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

                if($course['course_update'])
                {
                    //Asiganaciones Retomadas
                    $assignment = Assignment::where('student_id', $request->student_id)
                                    ->where('course_id', $course['course_id'])->first();

                    $assignment->description = $assignment->description." - ".$date_now."(".$course['course_a_description'].", Venta: ". $sale->code.")";
                    $assignment->start_date = $date_now;

                    //Suma un año a la Fecha
                    $fecha_actual = $date_now;
                    $nuevafecha = date("Y-m-d",strtotime($fecha_actual."+ 1 year"));

                    $assignment->final_date = $nuevafecha;

                    //Resta de Fechas
                    $final_date = Carbon::parse($assignment->final_date);
                    $dt = Carbon::now();
                    $remaining_days = $dt->diffInDays($final_date, false);
                    $assignment->remaining_days = $remaining_days;
                    $assignment->finished = 0;
                    $assignment->save();

                } else {

                    //Asiganaciones Nuevas
                    $assignment = new Assignment();
                    $codea = str_pad(($course['course_code']).(($assignment->orderBy('id', 'DESC')->pluck('id')->first() + 1)), 10, "0", STR_PAD_LEFT);
                    $assignment->code = str_slug($codea);
                    $assignment->sale_id = $sale->id;
                    $assignment->student_id = $request->student_id;
                    $assignment->course_id = $course['course_id'];
                    $assignment->description_sale = $request->description;
                    $assignment->description = $date_now."(".$course['course_a_description'].")";
                    $assignment->access = false;
                    $assignment->entry = false;
                    $assignment->poll = false;
                    $assignment->physical_certificate = false;
                    $assignment->date = $date_now;
                    $assignment->start_date = $date_now;

                    //Suma un año a la Fecha
                    $fecha_actual = $date_now;
                    $nuevafecha = date("Y-m-d",strtotime($fecha_actual."+ 1 year"));

                    $assignment->final_date = $nuevafecha;

                    //Resta de Fechas
                    $final_date = Carbon::parse($assignment->final_date);
                    $dt = Carbon::now();
                    $remaining_days = $dt->diffInDays($final_date, false);
                    $assignment->remaining_days = $remaining_days;

                    $assignment->save();

                }

            }

            DB::commit();
            return response()->json($sale, 200);

        }catch (Throwable $errror) {
            DB::rollBack();
            return response()->json($errror, 500);
        }

    }

    public function create_pdf($code)
    {
        $sale = Sale::where('code' ,'=', $code)->first();

        $pdf = PDF::loadView('pdf.sale', compact('sale'));

        return $pdf->download('venta_'.$sale->code.'.pdf');

    }

}
