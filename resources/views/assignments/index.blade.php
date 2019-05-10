@extends('layouts.master')

@section('title', '| Lista de Asignaciones')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3>Lista de Asignaciones</h3>
            <hr>
            {!! Form::open(['route' => 'assignments.index', 'method' => 'GET']) !!}
            <div class="form group">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Código" name="searchcode" id="searchcode" value="{{ (isset($request->searchcode))?$request->searchcode:'' }}">
                    <select name="searchcourse" id="searchcourse" class="form-control">
                        <option value="">Todos los Cursos</option>
                        @foreach ($courses as $course)     

                        <option value="{{ $course->id }}"
                            @isset($request->searchcourse)
                                @if ($course->id==$request->searchcourse)
                                    selected
                                @endif
                            @endisset
                            >{{ $course->name }}
                        </option>

                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
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
