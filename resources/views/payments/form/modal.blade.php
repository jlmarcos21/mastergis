
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="projectModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="projectModal">Datos del Pago</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body container">
        {!! Form::open(['route' => 'payments.store']) !!}
            <div class="row">
                {{ Form::hidden('sale_id', $sale->id) }}                
                <div class="col-md-4 form-group">                
                    {{ Form::label('previous_amount', 'Deuda Anterior') }}
                    {{ Form::number('previous_amount', $sale->debt, ['class' => 'form-control text-center', 'step' => 'any', 'readonly']) }}
                </div>
                <div class="col-md-4 form-group">                
                    {{ Form::label('amount', 'Pago') }}
                    {{ Form::number('amount', null, ['class' => 'form-control text-center', 'step' => 'any', 'required']) }}
                </div>
                <div class="col-md-4 form-group">                
                    {{ Form::label('date', 'Fecha') }}
                    {{ Form::date('date', null, ['class' => 'form-control text-center', 'step' => 'any', 'required']) }}
                </div>
                <div class="col-md-12 form-group">                
                    {{ Form::label('description', 'Descripción del Proyecto') }}
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 2, 'style' => 'resize:none']) }}
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Añadir</button>
                </div>
            </div>
        {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>
