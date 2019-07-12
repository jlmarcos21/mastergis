<?php

namespace App\DataTables;

use App\Student;
use Yajra\DataTables\Services\DataTable;

class StudentsDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('name', function($student) {
                return '<a href="'.route('students.show', $student->id).'" title="Perfil del Estudiante">'.$student->name.' '.$student->lastname.'</a>';
            })->editColumn('state', function($student) {
                return $student->state=='0'?'<span class="text-danger">Inactivo</span>':'<span class="text-success">Activo</span>';
            })->editColumn('country', function($student) {
                return '<span title="'.$student->country->description.'" class="'.$student->country->flag.'"></span><small class="d-none">'.$student->country->description.'</small>';
            })->editColumn('province', function($student) {
                return $student->province->description;
            })->addColumn('edit', function ($student) {                
                return '<a class="btn btn-sm btn-primary" href="'.route('students.edit', $student->id).'"><i class="far fa-edit"></i></a>';
            })->editColumn('sales', function($student) {
                return $student->sales->count();
            })->editColumn('assignments', function($student) {
                return $student->assignments->count();
            })->rawColumns(['name', 'state', 'country', 'edit']);
    }

    public function query()
    {
        $sales = Student::where('state', '=', '1')->get();
        return $sales;
    }

    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->parameters([
                        'order'   => [[0, 'desc']],
                        'dom' => 'Bfrtip',
                        'buttons' => [                    
                            ['extend' => 'export'],                   
                            ['extend' => 'print'],
                            ['extend' => 'reset'],
                            ['extend' => 'reload'],            
                        ],
                        'language' => ['url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json']
                    ]);
    }

    protected function getColumns()
    {
        return ([
            ['data' => 'id', 'title' => '#'],
            ['data' => 'name', 'title' => 'Nombre y Apellido'],
            ['data' => 'sex', 'title' => 'Sexo'],
            ['data' => 'code', 'title' => 'Código'],            
            ['data' => 'country', 'title' => 'País'],
            ['data' => 'province', 'title' => 'Provincia'],
            ['data' => 'email', 'title' => 'Correo'],
            ['data' => 'sales', 'title' => 'Ventas'],
            ['data' => 'assignments', 'title' => 'Asignaciones'],
            ['data' => 'edit', 'title' => '<i class="far fa-edit"></i>', 'className' => 'text-center']            
        ]);
    }

    protected function filename()
    {
        return 'estudiantes_' . date('YmdHis');
    }
}
