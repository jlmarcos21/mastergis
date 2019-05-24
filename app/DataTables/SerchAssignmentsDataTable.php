<?php

namespace App\DataTables;

use App\Assignment;
use Yajra\DataTables\Services\DataTable;

class SerchAssignmentsDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', 'serchassignmentsdatatable.action');
    }

    public function query()
    {
        $state = $this->state;
        $assignments = Assignment::where('finished', '=', $state)->get();
        return $assignments;
    }

    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->parameters([                        
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
            ['data' => 'code', 'title' => 'Código'],
            ['data' => 'finished', 'title' => 'Estado'],
        ]);
    }

    protected function filename()
    {
        return 'filtro_de_asginaciones_' . date('YmdHis');
    }
}
