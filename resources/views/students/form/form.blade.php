<div class="row">

    <div class="form-group col-md-4">
        {{ Form::label('name', 'Nombre del Estudiante') }}
        {{ Form::text('name', null, ['class' => 'form-control border border-success', 'id' => 'name', 'required', 'maxlength' => '150', 'autofocus']) }}
    </div>
    
    <div class="form-group col-md-4">
        {{ Form::label('lastname', 'Apellido del Estudiante') }}
        {{ Form::text('lastname', null, ['class' => 'form-control border border-success', 'id' => 'lastname', 'required', 'maxlength' => '150']) }}
    </div>

    <div class="form-group col-md-4">
        {{ Form::label(null, 'Sexo del Estudiante') }}
        <select name="sex" id="sex" class="selectpicker form-control" data-size="5" data-style="border border-success" data-live-search="true" title="Selecciona El Sexo" required>            
            <option                    
            @isset($student)
                {{old('sex',$student->sex)=='MASCULINO'? 'selected':''}}
            @endisset
            value="MASCULINO" data-icon="fas fa-male text-primary">
                MASCULINO
            </option>
            <option
            @isset($student)
                {{old('sex',$student->sex)=='FEMENINO'? 'selected':''}}
            @endisset
            value="FEMENINO" data-icon="fas fa-female text-danger">
                FEMENINO
            </option>            
        </select>
    </div>

    <div class="form-group col-md-4">
        {{ Form::label(null, 'Nacionalidad del Estudiante') }}
        <div class="row">
            <div class="col-sm-6">
                    <label>{{ Form::radio('nationality', 'NACIONAL', null, ['id' => 'nationality']) }} NACIONAL</label>
            </div>
            <div class="col-sm-6">
                <label>{{ Form::radio('nationality', 'EXTRANJERO') }} EXTRANJERO</label>
            </div>
        </div>        
    </div>

    <div class="form-group col-md-4">
        {{ Form::label('country_id', 'País del Estudiante') }}
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

    <div class="form-group col-md-4">
        {{ Form::label('email', 'Correo del Estudiante') }}
        {{ Form::text('email', null, ['class' => 'form-control border border-success', 'id' => 'email', 'required', 'maxlength' => '240']) }}
    </div>

    <div class="form-group col-md-4">
        {{ Form::label('phone', 'Celular del Estudiante') }}
        {{ Form::text('phone', null, ['class' => 'form-control border border-success', 'id' => 'phone', 'maxlength' => '25']) }}
    </div>

    <div class="form-group col-md-12">
        <button class="btn btn-primary">Guardar Datos</button>
        <a href="{{ route('students.index') }}" class="btn btn-danger">Cancelar</a>        
    </div>
</div>

@section('scripts')

    <script>
        $(()=> {
            $('#nationality').change(()=> {                
                $('#country_id option[value=1]').prop('selected', 'selected').change();
                $('.selectpicker').selectpicker('refresh')
            });
        })
    </script>

@endsection