<div class="row">

    <div class="form-group col-md-4">
        {{ Form::label('name', 'Nombre') }}
        {{ Form::text('name', null, ['class' => 'form-control border border-success', 'id' => 'name', 'required', 'maxlength' => '150', 'autofocus']) }}
    </div>
    
    <div class="form-group col-md-4">
        {{ Form::label('lastname', 'Apellido') }}
        {{ Form::text('lastname', null, ['class' => 'form-control border border-success', 'id' => 'lastname', 'required', 'maxlength' => '150']) }}
    </div>

    <div class="form-group col-md-4">
        {{ Form::label(null, 'Sexo') }}
        <select name="sex" id="sex" class="selectpicker form-control" data-size="5" data-style="border border-success" data-live-search="true" title="Selecciona El Sexo" required>            
            <option                    
            @isset($student)
                {{old('sex',$student->sex)=='Masculino'? 'selected':''}}
            @endisset
            value="Masculino" data-icon="fas fa-male text-primary">
                Masculino
            </option>
            <option
            @isset($student)
                {{old('sex',$student->sex)=='Femenino'? 'selected':''}}
            @endisset
            value="Femenino" data-icon="fas fa-female text-danger">
                Femenino
            </option>            
        </select>
    </div>

    <div class="form-group col-md-3">
        {{ Form::label('country_id', 'País') }}
        <select name="country_id" id="country_id" class="selectpicker form-control" data-size="5" data-style="border border-success" data-live-search="true" title="Selecciona su País" required>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}" data-icon="{{ $country->flag }}"
                    @isset($student)
                        @if($student->country_id==$country->id)
                            selected 
                        @endif
                    @endisset>
                        {{ $country->description }}
                </option>
            @endforeach
        </select>              
    </div>

    <div class="form-group col-md-3">
        {{ Form::label('province_id', 'Provincia') }}
        <select name="province_id" id="province_id" class="selectpicker form-control border-success" data-size="5" data-style="border border-success" data-live-search="true" title="Selecciona su Provincia" required>
        </select>
    </div>

    <div class="form-group col-md-3">
        {{ Form::label('email', 'Correo') }}
        {{ Form::email('email', null, ['class' => 'form-control border-success', 'id' => 'email', 'required', 'maxlength' => '240']) }}
    </div>

    <div class="form-group col-md-3">
        {{ Form::label('phone', 'Celular') }} <small class="text-danger">(Opcional)</small>
        {{ Form::text('phone', null, ['class' => 'form-control border-success', 'id' => 'phone', 'maxlength' => '25']) }}
    </div>

    <div class="form-group col-md-12">
        <button class="btn btn-primary">Guardar Datos</button>
        <a href="{{ route('students.index') }}" class="btn btn-danger">Cancelar</a>        
    </div>
</div>

@section('scripts')
<script>
    $("#country_id").change(event => {
        $.get(`{{ env('APP_URL') }}countries/${event.target.value}`, function(res, sta){
            $("#province_id").empty();
            res.forEach(element => {                
                $("#province_id").append(`<option value="${element.id}" data-icon="far fa-building">${element.description}</option>`);                
            });
            $('.selectpicker').selectpicker('refresh');
            $("#province_id").focus();        
        });
    });
</script>

@isset($student)
    <script>    
        $.get(`{{ env('APP_URL') }}countries/{{$student->country->id}}`, function(res, sta){
            $("#province_id").empty();            
            res.forEach(element => {
                $('.selectpicker').selectpicker('refresh');          
                if(element.id=={{ isset($student->province->id)?$student->province->id:'1'}})
                    $("#province_id").append(`<option value="${element.id}" data-icon="far fa-building" selected>${element.description}</option>`);
                else
                    $("#province_id").append(`<option value="${element.id}" data-icon="far fa-building">${element.description}</option>`);
            });
            $('.selectpicker').selectpicker('refresh');
            $("#province_id").focus();        
        });    
    </script>
@endisset

@endsection