@extends('layouts.master')

@section('title', '| Información de la Consulta')
    
@section('content')
    <div class="row">
        <div class="col-md-4 py-1">
            <div class="card border-dark">
                <div class="card-header bg-dark text-white d-flex">
                    <div class="p-2 mr-auto">
                        <h3>{{ $consultation->student->state==1?'Estudiante':'Interesado' }}</h3>
                    </div>
                    @if($consultation->student->state!=1)
                        <div class="p-2">
                            <a href="{{ route('change.student', $consultation->student->id) }}" class="btn btn-sm btn-block btn-success" onclick="return confirm('Desea Pasar a {{ $consultation->student->name.' '.$consultation->student->lastname }} como Estudiante?')" title="Pasar a Estudiante">
                                <i class="fas fa-exchange-alt"></i>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <Label><strong>Nombre y Apellido:</strong><br> {{ $consultation->student->name." ".$consultation->student->lastname }}</Label>                        
                    </div>
                    <div class="form-group">
                        <Label><strong>Sexo:</strong> {{ $consultation->student->sex }}</Label>                        
                    </div>
                    <div class="form-group">
                        <Label><strong>País:</strong> {{ $consultation->student->country->description }} <span class="{{ $consultation->student->country->flag }}"></span></Label>                        
                    </div>
                    <div class="form-group">
                        <Label><strong>Provincia:</strong> {{ $consultation->student->province->description }}</Label>                        
                    </div>
                    <div class="form-group">
                        <label><strong>Celular:</strong> {{ $consultation->student->phone }}</label>
                    </div>
                    <div class="form-group">
                        <label><strong>Correo:</strong> {{ $consultation->student->email }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 py-1">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Consulta</h3>
                </div>
                <div class="card-body row">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <h3>{{ $consultation->course->name }} <img src="{{ $consultation->course->image_url }}" width="70px"></h3>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><strong>Usuario</strong></label>
                            <br>
                            <label>{{ $consultation->user->name }}</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><strong>Contacto</strong></label>
                            <br>
                            <label>{{ $consultation->contact->description }}</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><strong>Nivel de Interés</strong></label>
                            <br>
                            <span>{{ $consultation->interest->name }}</span> {!! $consultation->interest->stars !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><strong>Fecha</strong></label>
                            <br>
                            <label>{{ $consultation->date }}</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><strong>Fecha de Recordatorio</strong></label>
                            <br>                            
                            <label>{{ $consultation->reminder_date }}</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group text-center">
                            <label><strong>Notificado</strong></label>
                            <br>
                            @if ($consultation->notification==0)
                                {!! Form::open(['route' => ['consultations.destroy', $consultation->id], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Desea Marcar como Notificado?")']) !!}
                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check-double"></i></button>
                                {!! Form::close() !!}
                            @else
                                <span class="text-success">Se Notificó</span>                                                   
                            @endif                                          
                        </div>
                    </div>
                     <div class="col-md-2">
                        <div class="form-group text-center">
                            <label><strong>Finalizar</strong></label>
                            <br>
                            @if ($consultation->finished==0)
                                {!! Form::open(['route' => ['finished_consultation', $consultation->id], 'method' => 'POST', 'onsubmit' => 'return confirm("Desea Finalizar el Proceso?")']) !!}
                                <button type="submit" class="btn btn-sm btn-danger">Finalizar</button>
                                {!! Form::close() !!}
                            @else
                                <span class="text-success">Finalizado</span>                                                   
                            @endif                                          
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><strong>Descripción</strong></label>
                            <br>
                            {{ $consultation->description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 py-1">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white d-flex">                    
                    <div class="p-2 mr-auto">
                        <h3>Preguntas</h3>
                    </div>
                    <div class="p-2">
                        <button class="btn btn-md btn-secondary" {{ $consultation->finished==1?'disabled':'' }} data-toggle="modal" data-target="#modal-consultation">Añadir</button>                        
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Contacto</th>
                                <th>Interés</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($consultation->details as $detail)
                            <tr>
                                <td>{{ $detail->user->name }}</td>
                                <td>{{ $detail->contact->description }} <i class="{{ $detail->contact->icon }}"></i></td>
                                <td><span style="color: {{ $detail->interest->colour }}">{{ $detail->interest->name }}</span> {!! $detail->interest->stars !!}
                                <td>{{ $detail->description }}</td>
                                <td>{{ $detail->date }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('consultations.form.modal')
    </div>
@endsection