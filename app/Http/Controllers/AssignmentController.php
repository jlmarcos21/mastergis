<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Assignment;
use App\SubLevel;

class AssignmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $assignments = Assignment::orderBy('created_at', 'DESC')->paginate(8);
        
        return view('assignments.index', compact('assignments'));
    }
    public function show($code)
    {
        $assignment = Assignment::where('code', '=', $code)->first();
        $sublevels = SubLevel::orderBy('id', 'ASC')->get();

        return view('assignments.show', compact('assignment', 'sublevels'));
    }

    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        return view('assignments.edit', compact('assignment'));
    }

    public function update(Request $request, $id)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->fill($request->all())->save();

        return redirect()->route('assignments.show', $assignment->code)->with('info', 'Asignacion Actualizada');
    }

    public function certificate($code)
    {
        $assignment = Assignment::where('code', '=', $code)->first();
    
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $date = "Lima, ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;        
        
        return view('assignments.certificate', compact('assignment','date'));
    }

}
