<?php
use Carbon\Carbon;

Auth::routes();

Route::group(['middleware' => 'cors'], function(){

    //Panel de Control
    Route::get('/', 'DashboardController@dashboard')->name('dashboard');

    //Country
    Route::resource('countries', 'CountryController')->except([
        'create', 'store', 'edit', 'update', 'destroy'
    ]);

    //Students
    Route::resource('students', 'StudentController');

    //Courses
    Route::resource('courses', 'CourseController');

    //Informacion para el componente Sale
    Route::get('api/get-data-sale','SaleController@getData');

    //Informacion de todos los estudiantes para el componente Sale
    Route::get('api/get-students','SaleController@get_students');

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
    
    Route::get('show_assignments/{id}', 'AssignmentController@show_assignments')->name('show_assignments');

    //certificate
    Route::get('generate-certificate/{code}', 'AssignmentController@certificate')->name('generate-certificate');
    
    //constancy
    Route::get('generate-constancy/{id}', 'AssignmentController@constancy')->name('generate-constancy');

    //annotation
    Route::get('generate-annotation/{id}', 'AssignmentController@annotation')->name('generate-annotation');

    Route::post('send_email', 'AssignmentController@sendEmail')->name('send.email');

    //Project
    Route::resource('projects', 'ProjectController')->except([
        'index', 'create', 'edit', 'update','destroy'
    ]);

    //SalesStatistics
    Route::resource('statistics', 'StatisticsController')->except([
        'store', 'edit', 'update', 'destroy'
    ]);

    //Consultation sales
    Route::get('search_sales', 'ReportController@search_sales')->name('search_sales');

    //Consultation courses
    Route::get('search_assignments', 'ReportController@search_assignments')->name('search_assignments');    

    //Generate PDF

    // PDF SAlE
    Route::get('pdf-sale/{code}', 'SaleController@create_pdf')->name('pdf.sale');

    
    Route::resource('consultations', 'ConsultationController')->except([
        'create', 'edit', 'update'
    ]);

    //Informacion de todos los estudiantes y intereados para el componente Consultation
    Route::get('consultation-students','ConsultationController@get_students');

    //Informacion de todos los estudiantes y intereados para el componente Consultation
    Route::get('consultation-data','ConsultationController@get_data');

    //cambiar de interesado a estudiante
    Route::get('change_student/{id}', 'ConsultationController@change_student')->name('change.student');

    //se listara el las notificaciones de nuestro layout
    Route::get('get_consultations', 'ConsultationController@get_consultations')->name('get.consultations');

    //obtener toada la informacion de estudiante o interesado escogido
    Route::get('get_information_student/{student_id}', 'ConsultationController@get_information_student')->name('get.informations');

    //obtener toada la informacion de estudiante o interesado escogido
    Route::post('save_detail', 'ConsultationController@save_detail')->name('save_detail');

    //dar por finalizado una consulta
    Route::post('finished_consultation/{id}', 'ConsultationController@finished_consultation')->name('finished_consultation');

    Route::get('search_year/{year}', 'DashboardController@search_year')->name('search_year');

    //Levantar migraciones
    Route::get('migrate', function () {
        Artisan::call('migrate:fresh', ['--seed' => true]);        
        return redirect()->route('students.index')->with('info', 'Migración correcta');
    });

});