<?php
use Carbon\Carbon;

Auth::routes();


Route::group(['middleware' => 'cors'], function(){

    //Panel de Control
    Route::get('/', 'DashboardController@dashboard')->name('dashboard');

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

    //certificate
    Route::get('generate-certificate/{code}', 'AssignmentController@certificate')->name('generate-certificate');
    
    //constancy
    Route::get('generate-constancy/{id}', 'AssignmentController@constancy')->name('generate-constancy');

    //annotation
    Route::get('generate-annotation/{id}', 'AssignmentController@annotation')->name('generate-annotation');

    //Project
    Route::resource('projects', 'ProjectController')->except([
        'index', 'create', 'edit', 'update','destroy'
    ]);

    //SalesStatistics
    Route::resource('statistics', 'StatisticsController')->except([
        'store', 'edit', 'show', 'update', 'destroy'
    ]);

});