<?php

namespace App\DataTables;

use App\Course;
use Yajra\DataTables\Services\DataTable;

class CoursesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('name', function($course) {
                return '<a href="'.route('courses.show', $course->id).'" title="Detalles del Curso">'.$course->name.'</a>';
            })->editColumn('level', function($course) {
                return '<i class="fas fa-circle" style="color: '.$course->level->colour.'"></i> '.$course->level->description;                    
            })->editColumn('image', function($course) {
                return '<img src="'.$course->image_url.'" alt="'.$course->name.'" width="50px" class="img-fluid">';                                
            })->addColumn('buttom', function ($course) {                
                return '<a class="btn btn-sm btn-primary" href="'.route('courses.edit', $course->id).'"><i class="far fa-edit"></i> Editar</a>';
            })->rawColumns(['name', 'level', 'image', 'buttom']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $courses = Course::with('level')->get();
        return $courses;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
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

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return ([
            ['data' => 'id', 'title' => '#'],
            ['data' => 'name', 'title' => 'Nombre'],
            ['data' => 'code', 'title' => 'Código'],
            ['data' => 'level', 'title' => 'Nivel'],
            ['data' => 'image', 'title' => 'Imagen'],
            ['data' => 'buttom', 'title' => '<i class="far fa-edit"></i>'],
        ]);
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'cursos_' . date('YmdHis');
    }
}
