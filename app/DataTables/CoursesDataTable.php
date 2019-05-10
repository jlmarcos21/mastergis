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
                ->editColumn('level', function($course) {
                    return '<i class="fas fa-circle" style="color: '.$course->level->colour.'"></i> '.$course->level->description;                    
                })->editColumn('image', function($course) {
                    return '<img src="'.$course->image_url.'" alt="'.$course->name.'" width="50px" class="img-fluid">';                                
                })->addColumn('buttom', function ($course) {                
                    return '<div class="dropdown">
                    <button class="btn btn-sm btn-danger dropdown-toggle" type="button" id="'.$course->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                                            
                    </button>
                    <div class="dropdown-menu" aria-labelledby="ddm-'.$course->id.'">
                        <a class="dropdown-item" href="'.route('courses.edit', $course->id).'"><i class="far fa-edit"></i> Editar</a>
                        <a class="dropdown-item" href="'.route('courses.show', $course->id).'"><i class="fas fa-info"></i> Detalles</a>
                    </div>
                </div>';
                })->rawColumns(['level', 'image', 'buttom']);
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
        return 'Courses_' . date('YmdHis');
    }
}
