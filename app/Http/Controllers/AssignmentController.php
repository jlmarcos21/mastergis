<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\DataTables\AssignmentsDataTable;
use App\Assignment;
use App\SubLevel;
use App\Project;
use App\Course;

class AssignmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $courses = Course::withCount(['assignments'])
                    ->orderBy('assignments_count', 'DESC')              
                    ->get();                            
        
        return view('assignments.index', compact('courses'));
    }

    public function show_assignments($id, AssignmentsDataTable $dataTable)
    {        
        return $dataTable->with('id', $id)->render('assignments.lists');
    }    

    public function show($code)
    {
        $assignment = Assignment::where('code', '=', $code)->first();

        $final_date = Carbon::parse($assignment->final_date);
        $dt = Carbon::now();                        
        $remaining_days = $dt->diffInDays($final_date, false);              
        $assignment->remaining_days = $remaining_days;
        $assignment->save();

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $date = "Lima, ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ; 

        $sublevels = SubLevel::orderBy('id', 'ASC')->get();

        return view('assignments.show', compact('assignment', 'sublevels', 'date'));
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

        $certificate = array_map('trim', explode( '|', $assignment->course->certificate));
    
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $date = "Lima, ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;        
        
        return view('assignments.certificates.certificate', compact('assignment', 'certificate', 'date'));
    }

    public function constancy($id)
    {
        $project = Project::findOrFail($id);

        $assignment = Assignment::findOrFail($project->assignment_id);

        $certificate = array_map('trim', explode( '|', $assignment->course->certificate));
    
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $date = "Lima, ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;        
        
        return view('assignments.certificates.constancy', compact('project','assignment', 'certificate', 'date'));
    }

    public function annotation($id)
    {
        $project = Project::findOrFail($id);

        $descriptions = array_map('trim', explode( '|', $project->description));

        $assignment = Assignment::findOrFail($project->assignment_id);     
        
        return view('assignments.certificates.annotation', compact('project','assignment', 'descriptions'));
    }

    public function sendEmail(Request $request)
    {
        $data = array(
            'body'=> $request->editor,
            'from'=> $request->from,
            'email'=> $request->email,
            'subject'=> $request->subject
        );

        $files = $request->file('files');

        Mail::send('emails.email_info', compact('data'), function($message) use ($data, $files){                 
            $message->from('dadanielita5@gmail.com', $data['from']);
            $message->to($data['email'])->subject($data['subject']);
            if($files != null) {
                foreach($files as $file) {
                    $message->attach($file->getRealPath(), array(
                        'as' => $file->getClientOriginalName(), // If you want you can chnage original name to custom name      
                        'mime' => $file->getMimeType())
                    );
                }
            }
        });

        return redirect()->route('dashboard')->with('info', 'Se Envio el Correo Correctamente');        
    }
}