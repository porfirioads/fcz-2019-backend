@extends('users.master', ['card_type' => 'card-register', 'card_title' => 'Registro de usuario'])

@section('page-title')
  Registro de usuario
@endsection

@section('stylesheets')
  @include('imports.stylesheets')
@endsection

@section('content')
  <form method="post" action="{{ route('user.register.action') }}" novalidate>
    @csrf

    <div class="form-group">
      <div class="form-row">
        <div class="col-md-4 col-sm-12">
          <div class="form-label-group">
            <input type="text" id="nombre" name="nombre" class="form-control"
                   placeholder="Nombre"
                   autofocus="autofocus"
                   value="{{old('nombre')}}">
            <label for="nombre">Nombre</label>
          </div>
        </div>
        <div class="col-md-4 col-sm-12">
          <div class="form-label-group">
            <input type="text" id="primer_apellido" name="primer_apellido" class="form-control"
                   placeholder="Primer apellido"
                   value="{{old('primer_apellido')}}">
            <label for="primer_apellido">Primer apellido</label>
          </div>
        </div>
        <div class="col-md-4 col-sm-12">
          <div class="form-label-group">
            <input type="text" id="segundo_apellido" name="segundo_apellido"
                   class="form-control"
                   placeholder="Segundo apellido"
                   value="{{old('segundo_apellido')}}">
            <label for="segundo_apellido">Segundo apellido</label>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="form-label-group">
        <input type="email" id="email" name="email" class="form-control" placeholder="Email"
               value="{{old('email')}}">
        <label for="email">Email</label>
      </div>
    </div>

    <div class="form-group">
      <div class="form-row">
        <div class="col-md-6">
          <div class="form-label-group">
            <input type="password" id="password" name="password" class="form-control"
                   placeholder="Contraseña">
            <label for="password">Contraseña</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-label-group">
            <input type="password" id="confirmPassword" name="confirmPassword"
                   class="form-control"
                   placeholder="Confirmar contraseña">
            <label for="confirmPassword">Confirmar contraseña</label>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="form-row">
        <div class="col-md-6">
          <label for="ocupacion_id" class="placeholder-hidden-label">Ocupación</label>
          <select id="ocupacion_id" name="ocupacion_id" class="form-control">
            <option disabled selected></option>
            @foreach($ocupaciones as $ocupacion)
              <option value="{{$ocupacion->id}}"
                {{$ocupacion->id == old('ocupacion_id') ? 'selected': ''}}>
                {{$ocupacion->nombre}}
              </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-6">
          <label for="institucion_id" class="placeholder-hidden-label">Institución</label>

          <select id="institucion_id" name="institucion_id" class="form-control">
            <option disabled selected></option>
            @foreach($instituciones as $institucion)
              <option value="{{$institucion->id}}"
                {{$institucion->id == old('institucion_id') ? 'selected': ''}}>
                {{$institucion->nombre}}
              </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="form-row">
        <div class="col-md-12">
          <label for="biografia" class="placeholder-hidden-label">Biografía</label>
          <textarea id="biografia" name="biografia" class="form-control"
                    rows="5">{{old('biografia')}}</textarea>
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Crear cuenta</button>
  </form>

  <div class="text-left">
    <a class="d-block small mt-3" href="{{ route('user.login.view') }}">Iniciar sesión</a>
  </div>
@endsection

@section('scripts')
  hola
@append
