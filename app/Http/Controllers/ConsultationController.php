<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ConsultationRequest;

use Carbon\Carbon;

use App\DataTables\ConsultationsDataTable;

use App\Country;
use App\Student;
use App\Contact;
use App\Course;
use App\Interest;

use App\Sale;
use App\Assignment;
use App\Consultation;

use App\DetailConsultation;

class ConsultationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(ConsultationsDataTable $dataTable)
    {        
        
        $countries = Country::orderBy('description', 'ASC')->get();
                
        return $dataTable->render('consultations.index', compact('countries', 'students', 'courses'));
    }

    public function get_students(Request $request)
    {    
        $students = array();

        if($request->name)
        {
            $students = Student::orderBy('id', 'DESC')                    
                    ->with(['country', 'province', 'assignments', 'sales', 'consultations'])           
                    ->orWhereRaw("concat(name, ' ', lastname) LIKE '%".$request->name."%'")
                    ->orWhere('code', 'LIKE', "%$request->name%")
                    ->orWhere('email', 'LIKE', "%$request->name%")                                                             
                    ->take(10)->get();
        }

        return response()->json($students ,200);    
    }

    public function get_information_student($student_id)
    {
        $sales = Sale::orderBy('date', 'DESC')
                        ->where('student_id', $student_id)->get();

        $assignments = Assignment::orderBy('start_date', 'DESC')
                        ->with(['course'])
                        ->where('student_id', $student_id)->get();

        $consultations = Consultation::orderBy('change_date', 'DESC')
                        ->with(['user', 'contact', 'course', 'interest'])
                        ->withCount(['details'])
                        ->where('student_id', $student_id)->get();

        return response()->json([
            'sales' => $sales,
            'assignments' => $assignments,
            'consultations' => $consultations
        ], 200);
    }

    public function get_data(Request $request)
    {
        $contacts = Contact::orderBy('id', 'ASC')->get();
        $courses = Course::orderBy('name', 'DESC')->get();
        $interests = Interest::orderBy('id', 'ASC')->get();

        return response()->json([
            'courses' => $courses,
            'interests' => $interests,
            'contacts' => $contacts
        ] ,200);    
    }

    public function store(ConsultationRequest $request)
    {        

        $consultation = new Consultation();

        $consultation->student_id = $request->student_id;
        $consultation->user_id = auth()->user()->id;
        $consultation->contact_id = $request->contact_id;
        $consultation->course_id = $request->course_id;
        $consultation->interest_id = $request->interest_id;        
        $consultation->description = $request->description;
        $consultation->date = Carbon::now()->toDateString();
        $consultation->change_date = Carbon::now()->toDateString();
        $consultation->reminder_date = $request->reminder_date;
        
        $consultation->save();

        $url = route('consultations.index');

        return response()->json($url, 200);
    }

    public function get_consultations(Request $request)
    {
        $consultations = Consultation::with(['student', 'course', 'interest'])                        
                        ->where('reminder_date', Carbon::now()->toDateString())
                        ->where('notification', '=', '0')
                        ->get();
                        
        return response()->json($consultations ,200);    
    }

    public function show($id)
    {
        $consultation = Consultation::findOrFail($id);

        $contacts = Contact::orderBy('id', 'ASC')->get();
        $interests = Interest::all();

        return view('consultations.show', compact('consultation', 'contacts', 'interests'));
    }

    public function change_student($id)
    {
        $student = Student::findOrFail($id);
        $student->state = 1;
        $student->save();

        return back()->with('info', $student->name.' '.$student->lastname.' Se Convirtio en Estudiante');
    }

    public function destroy($id)
    {        

        $consultation = Consultation::findOrFail($id);
        $consultation->notification = 1;
        $consultation->save();

        return redirect()->route('consultations.index')->with('info', 'Se Notificó a '.$consultation->student->name.' '.$consultation->student->lastname);
    }

    public function save_detail(Request $request)
    {
        $consultation = Consultation::findOrFail($request->consultation_id);

        $detail = new DetailConsultation();
        $detail->consultation_id = $consultation->id;
        $detail->user_id = auth()->user()->id;
        $detail->contact_id = $request->contact_id;
        $detail->interest_id = $request->interest_id;
        $detail->description = $request->description;

        $date = Carbon::now()->toDateString();

        $detail->date = $date;

        $consultation->fill([
            'change_date' => $date            
        ])->save();

        $detail->save();

        return redirect()->route('consultations.show', $consultation->id)->with('info', 'Se Añadio Correctamente');
    }

    public function finished_consultation($id)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->finished = 1;
        $consultation->save();

        return redirect()->route('consultations.show', $consultation->id)->with('info', 'Proceso de la Consulta Finalizada');
    }

}
