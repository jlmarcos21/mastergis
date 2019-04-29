<div class="row">

        <div class="form-group col-md-4">
            {{ Form::label('name', 'Nombre del Curso') }}
            {{ Form::text('name', null, ['class' => 'form-control border border-success', 'id' => 'name', 'required', 'maxlength' => '150', 'autofocus']) }}
        </div>
        
        <div class="form-group col-md-4">
            {{ Form::label('code', 'Codigo del Curso') }}
            {{ Form::text('code', null, ['class' => 'form-control border border-success', 'id' => 'code', 'required', 'maxlength' => '150']) }}
        </div>            
    
        <div class="form-group col-md-4">
            {{ Form::label('level_id', 'Nivel del Curso') }}
            <select name="level_id" id="level_id" class="selectpicker form-control" data-style="border border-success" data-live-search="true" title="Seleccionar Niveles" required>
                @foreach ($levels as $level)
                    <option value="{{ $level->id }}" data-content="<i class='fas fa-circle' style='color:{{ $level->colour }}'></i> <strong>{{ $level->description }}</strong>"
                        @isset($course)
                            @if($course->level_id==$level->id)
                                selected
                            @endif
                        @endisset>                            
                    </option>
                @endforeach
            </select>                  
        </div>
    
        <div class="form-group col-md-4">
            {{ Form::label('certificate', 'Certificado del Curso') }}
            {{ Form::text('certificate', null, ['class' => 'form-control border border-success', 'id' => 'certificate', 'required', 'maxlength' => '250']) }}
        </div>
    
        <div class="form-group col-md-4">
            {{ Form::label('duration', 'Duracipon del Curso') }}
            {{ Form::text('duration', null, ['class' => 'form-control border border-success', 'id' => 'duration', 'required', 'maxlength' => '240']) }}
        </div>
    
        <div class="form-group col-md-4">
            {{ Form::label('image', 'Imagen del Curso') }} @isset($course) <a href="{{$course->image_url }}" target="_blank">(Ver Imagen)</a> @endisset 
            {{ Form::file('image', ['class' => 'form-control border border-success', 'id' => 'image']) }}
        </div>
    
        <div class="form-group col-md-12">
                <button class="btn btn-primary">Guardar Datos</button>
            <a href="{{ route('courses.index') }}" class="btn btn-danger">Cancelar</a>            
        </div>
    </div>