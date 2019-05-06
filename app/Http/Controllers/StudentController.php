<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function index()
    {
        $students = Student::orderBy('id', 'DESC')
                    ->where('state', '=', '1')
                    ->get();
        return view('students.index', compact('students'));
    }


    public function create()
    {
        $countries = Country::orderBy('description', 'ASC')->get();
        return view('students.create', compact('countries'));
    }

    public function store(StudentStoreRequest $request)
    {
        $student = Student::create($request->all());
        $code = str_slug(Str::substr($request->lastname, 0, 2).Str::substr($request->name, 0, 2).$student->id);
        $student->fill([
            'code' => $code            
        ])->save();

        return redirect()->route('students.index')->with('info', 'Registrado con éxito');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $countries = Country::orderBy('description', 'ASC')->get();
        return view('students.edit', compact('student', 'countries')); 
    }

    public function update(StudentUpdateRequest $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->fill($request->all())->save();
        
        return redirect()->route('students.index')->with('info', 'Actualizado con éxito');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->state = 0;
        $student->save();

        return back()->with('info', 'Eliminado correctamente');
    }
    
}
