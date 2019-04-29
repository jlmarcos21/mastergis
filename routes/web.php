<?php
use Carbon\Carbon;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


//Panel de Control
Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');

//Country
Route::resource('countries', 'CountryController')->except([
    'create', 'store', 'edit', 'show', 'update', 'destroy'
]);

//Students
Route::resource('students', 'StudentController');

//Courses
Route::resource('courses', 'CourseController');

//Informacion para el componente Sale
Route::get('api/get-data-sale','SaleController@getData');

//Sales
Route::resource('sales', 'SaleController')->except([
    'store', 'edit', 'update'
]);

//Payment
Route::resource('payments', 'PaymentController')->except([
    'create', 'edit', 'update'
]);

//Save Sale
Route::post('save-sale', 'SaleController@SaveSale');

//Assignment
Route::resource('assignments', 'AssignmentController')->except([
    'store', 'create', 'destroy'
]);

//Verification
Route::get('generate-certificate/{code}', 'AssignmentController@certificate')->name('generate-certificate');

//Project
Route::resource('projects', 'ProjectController')->except([
    'index', 'create', 'edit', 'update','destroy'
]);

//SalesStatistics
Route::resource('statistics', 'StatisticsController')->except([
    'store', 'edit', 'show', 'update', 'destroy'
]);