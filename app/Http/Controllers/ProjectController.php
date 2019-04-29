<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Assignment;

class ProjectController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {

        $assignment = Assignment::findOrFail($request->assignment_id);
        $project = Project::create($request->all());

        return redirect()->route('assignments.show', $assignment->code)->with('info', 'Proyecto Añadido');
    }

}
