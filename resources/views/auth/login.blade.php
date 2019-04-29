@extends('layouts.auth')

@section('content')

<div class="card card-login mx-auto mt-5">
    <div class="card-header">Iniciar Sesión</div>
    <div class="card-body">
    <form method="POST" action="{{ route('login') }}">
    @csrf
        <div class="form-group">
            <div class="form-label-group">
                <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Correo" value="{{ old('email') }}" required="required" autofocus="autofocus">
                <label for="email">Correo</label>
            </div>
        </div>
        <div class="form-group">
            <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña" required>                
                <label for="password">Contraseña</label>
            </div>
        </div>
        <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                Recordar Sesión
            </label>
        </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">
            Ingresar
        </button>
    </form>
    </div>
</div>

@endsection