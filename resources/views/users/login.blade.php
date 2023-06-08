@extends('users.master', ['card_type' => 'card-login', 'card_title' => 'Inicio de sesión'])

@section('page-title')
  Inicio de sesión
@endsection

@section('stylesheets')
  @include('imports.stylesheets')
@endsection

@section('content')
  <form method="post" action="{{ route('user.login.action') }}" novalidate>
    @csrf
    <div class="form-group">
      <div class="form-label-group">
        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="usuario"
               autofocus="autofocus" value="{{old('usuario')}}">
        <label for="usuario">Usuario</label>
      </div>
    </div>
    <div class="form-group">
      <div class="form-label-group">
        <input type="password" id="password" name="password" class="form-control"
               placeholder="Contraseña">
        <label for="password">Contraseña</label>
      </div>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
  </form>
@endsection
