<div class="row">

    <div class="form-group col-md-3">
        @if ($assignment->access==0)
            <div class="custom-control custom-checkbox">
                {{Form::checkbox("access", "1", old('access'), ["class" => "custom-control-input", "id" => "access"])}}
                <label class="custom-control-label" for="access">Acceso</label>
            </div>
        @else
            <span class="text-success">Acceso Otorgado</span>
        @endif        
    </div>
    <div class="form-group col-md-3">
        @if ($assignment->entry==0)
            <div class="custom-control custom-checkbox">
                {{Form::checkbox("entry", "1", old('entry'), ["class" => "custom-control-input", "id" => "entry"])}}   
                <label class="custom-control-label" for="entry">Ingreso</label>
            </div>            
        @else
            <span class="text-success">Ingreso Correcto</span>
        @endif 
    </div>        
    <div class="form-group col-md-3">
        @if ($assignment->poll==0)
            <div class="custom-control custom-checkbox">
                {{Form::checkbox("poll", "1", old('poll'), ["class" => "custom-control-input", "id" => "poll"])}}
                <label class="custom-control-label" for="poll">Encuesta</label>
            </div>
        @else
            <span class="text-success">Encuesta Realizada</span>
        @endif
    </div>
    <div class="form-group col-md-3">
        @if ($assignment->physical_certificate==0)
            <div class="custom-control custom-checkbox">
                {{Form::checkbox("physical_certificate", "1", old('physical_certificate'), ["class" => "custom-control-input", "id" => "physical_certificate"])}}
                <label class="custom-control-label" for="physical_certificate">Certificado Fisico</label>
            </div>
        @else
            <span class="text-success">Certificado Fisico Entregado</span>
        @endif
    </div>
    <div class="form-group col-md-12">
        @if ($assignment->access==0 || $assignment->entry==0 || $assignment->poll==0 || $assignment->physical_certificate==0)
            <button class="btn btn-success">Actualizar</button>
        @endif
        <a href="{{ route('assignments.show', $assignment->code) }}" class="btn btn-danger">Regresar</a>        
    </div>

</div>