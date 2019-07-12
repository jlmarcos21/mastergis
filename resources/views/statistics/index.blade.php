@extends('layouts.master')

@section('title', '| Estadisticas')

@section('content')
    <div class="row">
        <div class="col-md-12 py-2">
            <div class="card border-success">
                <div class="card-header d-flex">                    
                    <div class="p-2 mr-auto">
                        <h3>Ranking de Cursos Top(5)</h3>
                    </div>
                    <div class="p-2">
                        <a class="btn btn-sm btn-dark" data-toggle="collapse" href="#collapseCourses" role="button" aria-expanded="false" aria-controls="collapseCourses">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>                        
                    </div>
                </div>
                <div class="card-body collapse show" id="collapseCourses">
                    <input type="hidden" id="courses" value="{{ $courses }}" class="form-control">
                    <div id="chart-courses" style="height: 100%"></div>
                </div>
            </div>                                             
        </div>

        <div class="col-md-12 py-2">
            <div class="card border-danger">
                <div class="card-header d-flex">                
                    <div class="p-2 mr-auto">
                        <h3>Ranking de Estudiantes por Ventas Top(10)</h3>
                    </div>
                    <div class="p-2">
                        <a class="btn btn-sm btn-dark" data-toggle="collapse" href="#collapseStudents" role="button" aria-expanded="false" aria-controls="collapseStudents">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>                        
                    </div>
                </div>
                <div class="card-body collapse show" id="collapseStudents">
                    <input type="hidden" id="students" value="{{ $students }}" class="form-control"> 
                    <div id="chart-students" style="height: 100%"></div>
                </div>
            </div>
        </div>

        <div class="col-md-12 py-2">
            <div class="card border-warning">
                <div class="card-header d-flex">                
                    <div class="p-2 mr-auto">
                        <h3>Ranking de Estudiantes por Cursos Top(10)</h3>
                    </div>
                    <div class="p-2">
                        <a class="btn btn-sm btn-dark" data-toggle="collapse" href="#collapseStudentsC" role="button" aria-expanded="false" aria-controls="collapseStudentsC">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>                        
                    </div>
                </div>
                <div class="card-body collapse show" id="collapseStudentsC">
                    <input type="hidden" id="students_courses" value="{{ $students_courses }}" class="form-control"> 
                    <div id="chart-students_courses" style="height: 100%"></div>
                </div>
            </div>
        </div>

        <div class="col-md-12 py-2">
            <div class="card border-primary">
                <div class="card-header d-flex">                
                    <div class="p-2 mr-auto">
                        <h3>Ranking de Paises Top(15)</h3>
                    </div>
                    <div class="p-2">
                        <a class="btn btn-sm btn-dark" data-toggle="collapse" href="#collapseCountries" role="button" aria-expanded="false" aria-controls="collapseCountries">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>                        
                    </div>
                </div>
                <div class="card-body collapse show" id="collapseCountries">
                    <input type="hidden" id="countries" value="{{ $countries }}" class="form-control"> 
                    <div id="chart-countries" style="height: 100%"></div>
                </div>
            </div>
        </div>

        <div class="col-md-12 py-2">
            <div class="card border-primary">
                <div class="card-header d-flex">                
                    <div class="p-2 mr-auto">
                        <h3>Ranking de Provincias Top(20)</h3>
                    </div>
                    <div class="p-2">
                        <a class="btn btn-sm btn-dark" data-toggle="collapse" href="#collapseProvinces" role="button" aria-expanded="false" aria-controls="collapseProvinces">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>                        
                    </div>
                </div>
                <div class="card-body collapse show" id="collapseProvinces">
                    <input type="hidden" id="provinces" value="{{ $provinces }}" class="form-control"> 
                    <div id="chart-provinces" style="height: 100%"></div>
                </div>
            </div>
        </div>

        <div class="col-md-12 py-2">
            <div class="card border-primary">
                <div class="card-header">
                    <label><strong>Selecsionar País</strong></label>
                    <br>     
                    <select class="form-control selectpicker" data-size="5" data-style="border border-dark" data-live-search="true" title="Escoger un País" onchange="SearchProvince(this.value)">
                        <option value="0" disabled selected>Seleccionar un País</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->description }}</option>
                        @endforeach
                    </select>      
                </div>
                <div class="card-body">                    
                    <div id="search-provinces" style="height: 100%"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>

    <script>

        let URLPAGE = `{{ env('APP_URL') }}`;

        $(() => {

            //Chart 1
            var vcourses = $.parseJSON($("#courses").val());

            var names = []
            var assigments = []

            for(var i in vcourses){
                names.push(vcourses[i].name)
                assigments.push(parseFloat(vcourses[i].assignments_count))
            }  

            Highcharts.chart('chart-courses', {
                chart: {
                    type: 'column',
                },
                
                title: {
                    text: null
                },

                plotOptions: {
                    column: {
                        depth: 25
                    }
                },

                xAxis: {
                    categories: names,
                    labels: {
                        skew3d: true,
                        style: {
                            fontSize: '16px'
                        }
                    }
                },

                yAxis: {
                    title: {
                        text: 'Cantidad'
                    }
                },

                series: [
                        {
                            name: 'Venta',
                            data: assigments
                        },
                    ],

                credits : {
                    enabled : false            
                }

            });


            // Chart 2
            var vstudents = $.parseJSON($("#students").val());

            var students = []
            var sales = []

            for(var i in vstudents){
                students.push(vstudents[i].name + " " + vstudents[i].lastname)
                sales.push(parseFloat(vstudents[i].sales_count))
            }

            Highcharts.chart('chart-students', {

                title: {
                    text: null
                },

                xAxis: {
                    categories: students
                },

                yAxis: {
                    title: {
                        text: 'Ventas'
                    }
                },

                series: [{
                    type: 'column',
                    colorByPoint: true,
                    name: 'Ventas',
                    data: sales,
                    showInLegend: false
                }],

                credits : {
                    enabled : false            
                }

            });


            // Chart 3
            var vstudents_courses = $.parseJSON($("#students_courses").val());

            var students_c = []
            var courses_c = []

            for(var i in vstudents){
                students_c.push(vstudents_courses[i].lastname + ", " + vstudents_courses[i].name)
                courses_c.push(parseFloat(vstudents_courses[i].assignments_count))
            }

            Highcharts.chart('chart-students_courses', {

                chart: {
                    inverted: true,
                    polar: false
                },

                title: {
                    text: null
                },

                xAxis: {
                    categories: students_c
                },

                yAxis: {
                    title: {
                        text: 'Cursos'
                    }
                },

                series: [{
                    type: 'column',
                    colorByPoint: true,
                    name: 'Cursos',
                    data: courses_c,
                    showInLegend: false
                }],

                credits : {
                    enabled : false            
                }

            });


            //Chart 4
            var courses = $.parseJSON($("#countries").val());

            var data_courses = []        

            for(var i in courses){
                data_courses.push({
                    'name' : courses[i].description,
                    'y' : parseFloat(courses[i].students_count),
                    'flag' : courses[i].flag,
                })
            }

            Highcharts.chart('chart-countries', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },

                title: {
                    text: null
                },

                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br>Total: <b>{point.y}</b>'
                },

                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },

                series: [{
                    name: 'Estudiantes',
                    colorByPoint: true,
                    data: data_courses
                }],

                credits : {
                    enabled : false            
                }

            });


            //Chart 5
            var provinces = $.parseJSON($("#provinces").val());

            var data_provinces = [];

            for(var i in provinces){
                data_provinces.push({
                    'name' : provinces[i].country.description +' - '+ provinces[i].description,
                    'y' : parseFloat(provinces[i].students_count)                    
                })
            }

            Highcharts.chart('chart-provinces', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },

                title: {
                    text: null
                },

                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },

                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true
                        },
                        showInLegend: false
                    }
                },

                series: [{
                    name: 'Estudiantes',
                    colorByPoint: true,
                    data: data_provinces
                }],

                credits : {
                    enabled : false            
                }

            });


        })


        function SearchProvince(id) {

            var search_provinces = [];

            $.get(`${URLPAGE}statistics/${id}`, function(res){
                res.forEach(element => {
                    search_provinces.push({
                        'name' : element.description,                        
                        'y' : parseFloat(element.students_count)
                    })
                });                
            
                Highcharts.chart('search-provinces', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },

                    title: {
                        text: null
                    },

                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br>Total: <b>{point.y}</b>'
                    },

                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        }
                    },

                    series: [{
                        name: 'Estudiantes',
                        colorByPoint: true,
                        data: search_provinces
                    }],

                    credits : {
                        enabled : false            
                    }

                });
            });            
        }
        
    </script>
@endsection