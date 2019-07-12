<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\CountriesDataTable;

use App\Province;

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

    public function show($id)
    {        
        $provinces = Province::where('country_id', $id)->get();
        return response()->json($provinces, 200);
    }
}
