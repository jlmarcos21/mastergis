
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="projectModal">Añadir Proyecto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body container">
        {!! Form::open(['route' => 'projects.store', 'files' => true]) !!}
            <div class="row">                              
                <div class="col-md-3 form-group">
                    {{ Form::hidden('assignment_id', $assignment->id) }}
                    {{ Form::label('project', 'E. Proyecto') }}
                    <div class="custom-control custom-checkbox form-control text-center">
                        {{Form::checkbox("project", "1", old('project'), ["class" => "custom-control-input", "id" => "project"])}}
                        <label class="custom-control-label" for="project"> Recibido</label>
                    </div>
                </div>
                <div class="col-md-3 form-group">                    
                    {{ Form::label('sub_level_id', 'Nivel del Proyecto') }}
                    <select name="sub_level_id" id="sub_level_id" class="selectpicker form-control" data-style="border border-success" data-live-search="true" title="Selecciona su Nivel" required>
                        @foreach ($sublevels as $sublevel)
                            <option value="{{ $sublevel->id }}" data-content="<i class='fas fa-circle' style='color:{{ $sublevel->colour }}'></i> <strong>{{ $sublevel->description }}</strong>"></option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    {{ Form::label('state', 'Estado del Proyecto') }}
                    <select name="state" id="state" class="form-control">
                        <option value="1">Aprobado</option>
                        <option value="0">Desaprobado</option>
                    </select>
                </div>
                <div class="col-md-3 form-group">                
                    {{ Form::label('date', 'Fecha del Proyecto') }}
                    {{ Form::date('date', null, ['class' => 'form-control text-center', 'required']) }}
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
