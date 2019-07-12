@if ($canceled==0)
    {!! Form::open(['route' => ['sales.destroy', $id], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Desea Anular esta Venta?")']) !!}
    <button class="btn btn-sm btn-danger">
        <i class="fas fa-ban"></i>
    </button>                      
    {!! Form::close() !!}
@else
    <span class="text-danger">Anulado</span>
@endif