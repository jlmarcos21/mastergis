<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CoursesDataTable;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;

use App\Course;
use App\Level;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CoursesDataTable $dataTable)
    {
        return $dataTable->render('courses.index');        
    }

    public function create()
    {
        auth()->user()->authorizeRoles(['admin', 'marketing']);

        $levels = Level::all();
        return view('courses.create', compact('levels'));
    }

    public function store(CourseStoreRequest $request)
    {
        auth()->user()->authorizeRoles(['admin', 'marketing']);

        $course = Course::create($request->all());
        return redirect()->route('courses.index')->with('info', 'Registrado con éxito');
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);        
        
        return view('courses.show', compact('course'));
    }

    public function edit($id)
    {
        auth()->user()->authorizeRoles(['admin', 'marketing']);

        $course = Course::findOrFail($id);
        $levels = Level::all();
        return view('courses.edit', compact('course', 'levels'));
    }

    public function update(CourseUpdateRequest $request, $id)
    {
        auth()->user()->authorizeRoles(['admin', 'marketing']);

        $course = Course::findOrFail($id);
        $course->fill($request->all())->save();
        return redirect()->route('courses.index')->with('info', 'Actualizado con éxito');
    }

    public function destroy($id)
    {
        auth()->user()->authorizeRoles(['admin', 'marketing']);
        
        $course = Course::findOrFail($id);        
        $course->state = 0;
        $course->save();
        return back()->with('info', 'Eliminado correctamente');
    }
    
}
