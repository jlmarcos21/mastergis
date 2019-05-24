
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
                <div class="col-md-4 form-group">
                    {{ Form::hidden('assignment_id', $assignment->id) }}
                    {{ Form::label('sub_level_id', 'Nivel del Proyecto') }}
                    <select name="sub_level_id" id="sub_level_id" class="selectpicker form-control" data-style="border border-success" data-live-search="true" title="Selecciona su Nivel" required>
                        @foreach ($sublevels as $sublevel)
                            <option value="{{ $sublevel->id }}" data-content="<i class='fas fa-circle' style='color:{{ $sublevel->colour }}'></i> <strong>{{ $sublevel->description }}</strong>"></option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    {{ Form::label('state', 'Estado del Proyecto') }}
                    <select name="state" id="state" class="form-control">
                        <option value="1">Aprobado</option>
                        <option value="0">Desaprobado</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">                
                    {{ Form::label('date', 'Fecha del Proyecto') }}
                    {{ Form::date('date', null, ['class' => 'form-control text-center', 'required']) }}
                </div>
                <div class="col-md-12 form-group">                
                    {{ Form::label('description', 'Descripción del Proyecto') }} <small id="result" class="text-muted"></small> <small class="text-primary" id="alert" style="display: none">Realize el Salto de Linea</small>
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'rows' => 2, 'style' => 'resize:none', 'onKeyDown' => 'kotoba()', 'onKeyUp' => 'kotoba()']) }}
                    <span class="text-muted">* Solo 75 caracteres por parrafo</span>
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

@section('scripts')
    <script>       
       function kotoba() {
            $("#result").text("("+$("#description").val().length + " Caracteres)");

            let limit = 73;

            if ($("#description").val().length==limit || $("#description").val().length==limit*2 || $("#description").val().length==limit*3) {
                $("#alert").show('slow')
            }else{
                $("#alert").hide('slow')
            }     
        }
    </script>
@endsection
