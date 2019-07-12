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
        })->editColumn('country', function($assignment) {
            return $assignment->student->country->description.' <span class="'.$assignment->student->country->flag.'"></span>';
        })->editColumn('finished', function($assignment) {
            return $assignment->finished=='0'?'<span class="text-danger">No Terminado</span>':'<span class="text-success">Curso Terminado</span>';
        })->editColumn('remaining_days', function($assignment) {
            return $assignment->remaining_days<0?'<span class="text-danger">Curso Vencido</span>':'<span class="text-success">'.$assignment->remaining_days.'</span>';
        })->editColumn('projects', function($assignment) {
            return '<button type="button" class="btn btn-sm btn-primary">
                        Proyectos <span class="badge badge-light">'.$assignment->projects->count().'</span>
                    </button>';
            
        })->rawColumns(['code', 'country', 'student', 'course', 'finished', 'remaining_days', 'projects']);
    }

    public function query()
    {
        $id = $this->id;

        $assignments = Assignment::orderBy('start_date', 'DESC')
                ->orderBy('finished', 'ASC')
                ->where('course_id', '=', $id)
                ->with(['course', 'student'])
                ->get();

        return $assignments;
    }

    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->parameters([
                        'order'   => [[4, 'desc']],
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
            ['data' => 'country', 'title' => 'País'],            
            ['data' => 'finished', 'title' => 'Estado'],
            ['data' => 'start_date', 'title' => 'F. Inicio'],
            ['data' => 'final_date', 'title' => 'F- Final'],
            ['data' => 'remaining_days', 'title' => 'Dias restantes'],
            ['data' => 'projects', 'title' => 'Proyectos'],
        ]);
    }

    protected function filename()
    {
        return 'Asignaciones_' . date('YmdHis');
    }
}
