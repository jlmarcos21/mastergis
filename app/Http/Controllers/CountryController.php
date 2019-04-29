<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Country;

class CountryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {        
        $countries = Country::withCount(['students'])->orderBy('students_count', 'DESC')->get();

        return view('countries.index', compact('countries'));
    }
}
