<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;

use App\Project;
use App\Assignment;

class ProjectController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(ProjectRequest $request)
    {
        auth()->user()->authorizeRoles(['ADMIN']);

        $assignment = Assignment::findOrFail($request->assignment_id);

        if(($request->sub_level_id==1) && ($request->state==1)){
            $assignment->certificate = 1;
            $assignment->finished = 1;
        }            

        if(($request->sub_level_id==2) && ($request->state==1)){
            $assignment->basic_constancy = 1;
        }            

        if(($request->sub_level_id==3) && ($request->state==1)){
            $assignment->intermediate_constancy = 1;
        }            
        
        if(($request->sub_level_id==4) && ($request->state==1)){
            $assignment->advanced_constancy = 1;
        }            

        if(($assignment->basic_constancy) && ($assignment->intermediate_constancy) && ($assignment->advanced_constancy)){
            $assignment->certificate = 1;
            $assignment->finished = 1;
        }
            
        $assignment->save();

        $project = new Project();
        $project->assignment_id = $request->assignment_id;
        $project->user_id = auth()->user()->id;
        $project->sub_level_id = $request->sub_level_id;
        $project->description = $request->description;
        $project->state = $request->state;
        $project->date = $request->date;
        $project->save();

        return redirect()->route('assignments.show', $assignment->code)->with('info', 'Proyecto Añadido');
    }

}
