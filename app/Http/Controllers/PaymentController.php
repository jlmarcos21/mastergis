<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Payment;

use App\Sale;

class PaymentController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sales = Sale::orderBy('created_at', 'DESC')
                    ->where('credit', '=', '1')
                    ->paginate(10);
        return view('payments.index', compact('sales'));
    }

    public function store(Request $request)
    {
        $sale = Sale::findOrFail($request->sale_id);

        $newamount = number_format(($sale->debt - $request->amount), 2);

        $payment = new Payment();
        $payment->sale_id           = $sale->id;
        $payment->description       = $request->description;
        $payment->previous_amount   = $sale->debt;
        $payment->amount            = $request->amount;
        $payment->next_amount       = $newamount;
        $payment->date              = $request->date;
        $payment->save();

        $sale->debt = $newamount;
        $sale->save();
        
        return redirect()->route('payments.show', $sale->code)->with('info', 'Registrado con éxito');        
    }

    public function show($code)
    {
        $sale = Sale::where('code', '=', $code)->first();

        return view('payments.show', compact('sale'));
    }

}
