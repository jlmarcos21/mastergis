<div class="modal fade" id="EmailModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle del Mensaje</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'send.email', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-md-12 form-group">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="from" placeholder="De:" required>
                                <input type="text" class="form-control" name="subject" placeholder="Titulo:" required>
                                <input type="text" class="form-control" name="email" value="{{ $assignment->student->email }}" readonly placeholder="Para:">
                            </div>
                        </div>
                        <div class="form-group">
                           <textarea name="editor" id="editor" rows="10" cols="80" class="form-control">
                                Mensaje a enviar
                            </textarea> 
                        </div>
                        <div class="form-group">
                            <input type="file" name="files[]" accept="image/png, image/jpeg, application/pdf" multiple class="form-control" required>
                        </div>                        
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-block btn-primary">Enviar Correo</button>
                    </div>
                </div>                
                {!! Form::close() !!}     
            </div>
            </div>
        </div>
    </div>