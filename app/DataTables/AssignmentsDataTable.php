<?php

namespace App\DataTables;

use App\Assignment;
use Yajra\DataTables\Services\DataTable;

class AssignmentsDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
        ->editColumn('code', function($assignment) {
            return '<a href="'.route('assignments.show', $assignment->code).'">'.$assignment->code.'</a>';
        })->editColumn('student', function($assignment) {
            return $assignment->student->name." ".$assignment->student->lastname;
        })->editColumn('course', function($assignment) {
            return $assignment->course->name;
        })->rawColumns(['code', 'student', 'course']);
    }

    public function query()
    {
        $id = $this->id;

        $assignments = Assignment::where('course_id', '=', $id)
                ->with(['course', 'student'])
                ->get();

        return $assignments;
    }

    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->parameters([
                        'order'   => [[0, 'desc']],
                        'dom' => 'Bfrtip',
                        'buttons' => ([                    
                            ['extend' => 'export'],                   
                            ['extend' => 'print'],
                            ['extend' => 'reset'],
                            ['extend' => 'reload'],            
                        ]),
                        'language' => ['url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json']          
                    ]);
    }

    protected function getColumns()
    {
        return([
            ['data' => 'code', 'title' => 'Código'],
            ['data' => 'student', 'title' => 'Estudiante'],
            ['data' => 'course', 'title' => 'Curso'],
            ['data' => 'start_date', 'title' => 'F. Inicio'],
            ['data' => 'final_date', 'title' => 'F- Final'],
        ]);
    }

    protected function filename()
    {
        return 'Asignaciones_' . date('YmdHis');
    }
}
