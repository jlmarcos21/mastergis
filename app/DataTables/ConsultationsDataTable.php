<?php

namespace App\DataTables;

use App\Consultation;
use Yajra\DataTables\Services\DataTable;

class ConsultationsDataTable extends DataTable
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
                    ->editColumn('user', function($consultation) {
                        return $consultation->user->name;
                    })->editColumn('contact', function($consultation) {
                        return $consultation->contact->description . ' <i class="'.$consultation->contact->icon.'"></i>';
                    })->editColumn('student', function($consultation) {
                        return $consultation->student->name ." ". $consultation->student->lastname;
                    })->editColumn('country', function($consultation) {
                        return $consultation->student->country->description.' <span class="'.$consultation->student->country->flag.'"></span>';
                    })->editColumn('course', function($consultation) {
                        return '<span><img src="'.$consultation->course->image_url.'" width="40px"> '.$consultation->course->name.'</span>';
                    })->editColumn('interest', function($consultation) {
                        return '<div class="text-center"><span style="color: '.$consultation->interest->colour.'">'.$consultation->interest->name.'</span><br/>'.$consultation->interest->stars.'</div>';
                    })->editColumn('description', function($consultation) {
                        return '<a href="'.route('consultations.show', $consultation->id).'" title="Detalle de la Consulta">'.$consultation->description.'</a>';
                    })->editColumn('state', function($consultation) {
                        return $consultation->finished==1?'<span class="text-success">Finalizado</span>':'<span class="text-danger">No Finalizado</span>';
                    })->rawColumns(['contact', 'student', 'country', 'course', 'interest', 'description', 'state']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $consultations = Consultation::with(['user', 'contact', 'student', 'course', 'interest'])
                        ->orderBy('date', 'DESC')                        
                        ->get();
                                                                    
        return $consultations;
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
                        'order'   => [[7, 'desc']],
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
            ['data' => 'user', 'title' => 'Usuario'],
            ['data' => 'contact', 'title' => 'Contacto'],
            ['data' => 'student', 'title' => 'Interesado'],
            ['data' => 'country', 'title' => 'País'],
            ['data' => 'course', 'title' => 'Curso de Interés'],
            ['data' => 'interest', 'title' => 'Interés'],
            ['data' => 'description', 'title' => 'Descripción'],
            ['data' => 'date', 'title' => 'Fecha'],
            ['data' => 'state', 'title' => 'Estado'],
        ]);
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Consultas_' . date('YmdHis');
    }
}
