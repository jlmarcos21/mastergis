<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function index()
    {
        $courses = Course::orderBy('id', 'DESC')
                    ->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $levels = Level::all();
        return view('courses.create', compact('levels'));
    }

    public function store(CourseStoreRequest $request)
    {
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
        $course = Course::findOrFail($id);
        $levels = Level::all();
        return view('courses.edit', compact('course', 'levels'));
    }

    public function update(CourseUpdateRequest $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->fill($request->all())->save();
        return redirect()->route('courses.index')->with('info', 'Actualizado con éxito');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id)->delete();
        return back()->with('info', 'Eliminado correctamente');
    }
    
}
