@extends('layouts.master')

@section('title', '| Lista de Asignaciones')

@section('links')
    <style>
    
    .img-zoom{                
        overflow: hidden;
        cursor: pointer;   
    }

    .img-hover-zoom img {
        transition: transform .5s ease;
    }

    /* [3] Finally, transforming the image when container gets hovered */
    .img-hover-zoom:hover img {
        transform: scale(1.5);
    }
}

    </style>
@endsection

@section('content')

    <div class="row">
        @foreach ($courses as $course)
        <div class="col-md-3 py-2">
            <div class="w-100 img-zoom img-hover-zoom">
                <img src="{{ $course->image_url }}" class="img-fluid rounded" style="cursor: pointer" alt="{{ $course->name }}" data-toggle="tooltip" data-placement="bottom" title="Total de Estudiantes {{ $course->assignments->count() }}" onclick="location.href='{{ route('show_assignments', $course->id) }}'">
            </div>            
        </div>
        @endforeach
    </div>
@endsection
