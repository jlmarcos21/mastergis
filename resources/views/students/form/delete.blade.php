{!! Form::open(['route' => ['students.destroy', $id], 'method' => 'DELETE']) !!}
    @if ($state==1)
        <button class="btn btn-sm btn-danger">
            Desactivar
        </button>
    @else
        <button class="btn btn-sm btn-success">
            Activar
        </button>
    @endif                           
{!! Form::close() !!}