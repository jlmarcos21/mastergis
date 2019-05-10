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
                    return $student->lastname ." ". $student->name;
                })->editColumn('country', function($student) {
                    return '<span title="'.$student->country->description.'" class="'.$student->country->flag.'"></span><small class="d-none">'.$student->country->description.'</small>';                    
                })->addColumn('buttom', function ($student) {                
                    return '<div class="dropdown">
                    <button class="btn btn-sm btn-danger dropdown-toggle" type="button" id="ddm-'.$student->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                                            
                    </button>
                    <div class="dropdown-menu" aria-labelledby="ddm-'.$student->id.'">
                        <a class="dropdown-item" href="'.route('students.edit', $student->id).'"><i class="far fa-edit"></i> Editar</a>
                        <a class="dropdown-item" href="'.route('students.show', $student->id).'"><i class="far fa-user-circle"></i> Perfil</a>
                    </div>
                </div>';
                })->rawColumns(['country', 'buttom']);
    }

    public function query()
    {
        $sales = Student::with('country')->get();
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
                    ]);
    }

    protected function getColumns()
    {
        return ([
            ['data' => 'id', 'title' => '#'],
            ['data' => 'name', 'title' => 'Apellidos y Nombres'],
            ['data' => 'sex', 'title' => 'Sexo'],
            ['data' => 'code', 'title' => 'Código'],
            ['data' => 'country', 'title' => 'País'],
            ['data' => 'email', 'title' => 'Correo'],
            ['data' => 'buttom', 'title' => '<i class="far fa-edit"></i>', 'className' => 'text-center'],
        ]);
    }

    protected function filename()
    {
        return 'Students_' . date('YmdHis');
    }
}
