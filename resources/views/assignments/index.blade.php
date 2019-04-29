@extends('layouts.master')

@section('title', '| Lista de Asignaciones')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3>Lista de Asignaciones</h3>
            <hr>
        </div>
        @foreach ($assignments as $assignment)
        <div class="col-md-3 py-2">
            <div class="card text-center card-bg" onclick="location.href='{{ route('assignments.show', $assignment->code) }}'" data-toggle="tooltip" data-placement="bottom" title="Estudiante : {{ $assignment->student->lastname }}, {{ $assignment->student->name }}">
                <img src="{{ $assignment->course->image_url }}" class="card-img-top" alt="{{ $assignment->course->name }}">
                <div class="card-body">
                    <p class="card-text">{{ $assignment->course->name }}</p>
                    <p class="text-muted">{{ $assignment->code }}</p>

                    @php
                        $progress = $assignment->access+$assignment->entry+$assignment->poll
                    @endphp
                    
                    @if($progress==1)
                        <div class="progress">
                            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%"></div>
                        </div>
                    @elseif($progress==2)
                        <div class="progress">
                            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%"></div>
                        </div>
                    @elseif($progress==3)
                        <strong class="text-success">Curso Terminado</strong>
                    @endif
                                               
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-md-12">            
            <hr>
            {{ $assignments->render() }}
        </div>
    </div>

@endsection
