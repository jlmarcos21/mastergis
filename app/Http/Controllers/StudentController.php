<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\DataTables\StudentsDataTable;
use Illuminate\Support\Str;

use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;

use App\Student;
use App\Country;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(StudentsDataTable $dataTable)
    {        
        return $dataTable->render('students.index');    
    }

    public function create()
    {
        // auth()->user()->authorizeRoles(['admin', 'marketing']);

        $countries = Country::orderBy('description', 'ASC')->get();
        return view('students.create', compact('countries'));
    }

    public function store(StudentStoreRequest $request)
    {
        // auth()->user()->authorizeRoles(['admin', 'marketing']);

        $student = Student::create($request->all());
        $code = str_slug(Str::substr($request->lastname, 0, 2).Str::substr($request->name, 0, 2).$student->id);
        $student->fill([
            'code' => $code            
        ])->save();
        
        if(isset($request->state))
        {            
            return redirect()->route('consultations.index')->with('info', 'Registrado con éxito');
        } else {
            return redirect()->route('students.index')->with('info', 'Registrado con éxito');            
        }
                
    }

    public function show($id)
    {        
        $student = Student::where('state', '1')->findOrFail($id);
        return view('students.show', compact('student'));
    }

    public function edit($id)
    {
        // auth()->user()->authorizeRoles(['admin', 'marketing']);

        $student = Student::where('state', '1')->findOrFail($id);
        $countries = Country::orderBy('description', 'ASC')->get();
        return view('students.edit', compact('student', 'countries')); 
    }

    public function update(StudentUpdateRequest $request, $id)
    {
        // auth()->user()->authorizeRoles(['admin', 'marketing']);

        $student = Student::findOrFail($id);
        $student->fill($request->all())->save();
        
        return redirect()->route('students.index')->with('info', 'Actualizado con éxito');
    }

    public function destroy($id)
    {
        // auth()->user()->authorizeRoles(['admin', 'marketing']);

        $student = Student::findOrFail($id);
        if($student->state==1)
            $student->state = 0;
        else
            $student->state = 1;
        $student->save();

        return back()->with('info', 'Estado Actualizado');
    }
    
}
