<div class="modal fade bd-example-modal-sm show" id="modal-consultation" tabindex="-1" role="dialog" aria-modal="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Nuevo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">        
        {!! Form::open(['route' => 'save_detail']) !!}
            {{ Form::hidden('consultation_id', $consultation->id) }}
            <div class="form-group">
                {{ Form::label('contact_id', 'Contacto') }}
                <select class="selectpicker form-control" data-size="5" data-style="border-dark" data-live-search="true" title="Seleccionar Contacto" name="contact_id">
                @foreach ($contacts as $contact)
                    <option value="{{ $contact->id }}" data-icon="{{ $contact->icon }}">{{ $contact->description }}</option>
                @endforeach
                </select>             
            </div>
            <div class="form-group">
                {{ Form::label('interest_id', 'Interés') }}
                <select class="selectpicker form-control" data-size="5" data-style="border-dark" data-live-search="true" title="Seleccionar Interést" name="interest_id">
                @foreach ($interests as $interest)
                    <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                @endforeach
                </select>           
            </div>               
            <div class="form-group">
                {{ Form::label('description', 'Descripción') }}
                {{ Form::textarea('description', null, ['class' => 'form-control border-dark', 'id' => 'description', 'required', 'maxlength' => '150', 'rows' => '3', 'style' => 'resize:none']) }}
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-primary">Registrar</button>
            </div>
        {!! Form::close() !!}        
      </div>
    </div>
  </div>
</div>