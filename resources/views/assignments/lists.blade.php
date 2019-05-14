@extends('layouts.master')

@section('title', '| Lista de Asignacion por Curso')

@section('links')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
@endsection

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive py-3">
            {{-- <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Estudiante</th>
                        <th>Curso</th>
                        <th>F. Inicio</th>
                        <th>F. Final</th>    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assignments as $assignment)
                        <tr style="cursor: pointer" onclick="location.href='{{ route('assignments.show', $assignment->code) }}'">
                            <td>{{ $assignment->code }}</td>
                            <td>{{ $assignment->student->name }} {{ $assignment->student->lastname }}</td>
                            <td>{{ $assignment->course->name }}</td>
                            <td>{{ $assignment->start_date }}</td>
                            <td>{{ $assignment->final_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table> --}}
            {!! $dataTable->table() !!}
        </div>
    </div>
</div>

@endsection

@section('scripts')    
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endsection