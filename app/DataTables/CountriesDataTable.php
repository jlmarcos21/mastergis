<?php

namespace App\DataTables;

use App\Country;
use Yajra\DataTables\Services\DataTable;

class CountriesDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
                ->editColumn('flag', function($country) {
                    return '<span class="'.$country->flag.'"> <i class="d-none">'.$country->description.'</i></span>';
                })->editColumn('students', function($country) {
                    return $country->students_count;
                })->rawColumns(['flag']);
    }

    public function query()
    {
        $countries = Country::withCount(['students'])->orderBy('students_count', 'DESC')->get();

        return $countries;
    }

    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->parameters([
                        'order'   => [[2, 'desc']],
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
            ['data' => 'description', 'title' => 'País'],
            ['data' => 'flag', 'title' => 'Bandera'],
            ['data' => 'students', 'title' => 'Estudiantes']
        ]);
    }

    protected function filename()
    {
        return 'paises_' . date('YmdHis');
    }
}
