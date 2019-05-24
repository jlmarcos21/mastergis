<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\CountriesDataTable;

class CountryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CountriesDataTable $dataTable)
    {        
        return $dataTable->render('countries.index');
    }
}
