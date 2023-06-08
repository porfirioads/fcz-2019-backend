@extends('master', ['sd_ini_cl' => '', 'sd_eve_cl' => 'active',
  'sd_usu_cl' => '', 'sd_cat_cl' => '', 'sd_ins_cl' => ''])

@section('page-title')
  Edición de evento
@endsection

@section('stylesheets')
  @include('imports.stylesheets')
@endsection

@section('content')
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-calendar"></i>
      Editar {{$evento->nombre}}
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('event.edit.action', ['id' => $evento->id]) }}"
            novalidate
            enctype="multipart/form-data">
        @csrf
        {!! method_field('put') !!}
        <div class="form-group">
          <div class="form-group">
            <label for="nombre" class="placeholder-hidden-label">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control"
                   autofocus="autofocus"
                   value="{{old('nombre', $evento->nombre)}}">
          </div>
        </div>

        <div class="form-row">
          <div class="col-sm-4">
            <div class="form-group">
              <label for="fecha_inicio" class="placeholder-hidden-label">Fecha de inicio</label>
              <input type="text" class="form-control datetimepicker-input" id="fecha_inicio"
                     name="fecha_inicio"
                     data-toggle="datetimepicker" data-target="#fecha_inicio"
                     value="{{old('fecha_inicio', $evento->fecha_inicio)}}" autocomplete="off"/>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <label for="fecha_fin" class="placeholder-hidden-label">Fecha de fin</label>
              <input type="text" class="form-control datetimepicker-input" id="fecha_fin"
                     name="fecha_fin"
                     data-toggle="datetimepicker" data-target="#fecha_fin"
                     value="{{old('fecha_fin', $evento->fecha_fin)}}" autocomplete="off"/>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <label for="tipo" class="placeholder-hidden-label">Tipo de evento</label>
              <select id="tipo" name="tipo" class="form-control">
                <option disabled selected></option>
                @foreach($tipos_evento as $key => $tipo_evento)
                  <option value="{{$key}}"
                    {{old('tipo', $evento->tipo) === $key ? 'selected' : ''}}>
                    {{$tipo_evento}}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>


        <div class="form-group">
          <label for="descripcion" class="placeholder-hidden-label">Descripción</label>
          <textarea id="descripcion" name="descripcion" class="form-control"
                    rows="5">{{old('descripcion', $evento->descripcion)}}</textarea>
        </div>

        <div class="form-group">
          <label for="flyer" class="placeholder-hidden-label">Flyer</label>
          <img class="img-fluid img-thumbnail mw-100"
               src="{{asset("storage/$evento->flyer")}}"
               alt="{{$evento->nombre}}">
          <div class="custom-file mt-3">
            <input type="file" class="custom-file-input" id="flyer" name="flyer">
            <label class="custom-file-label" for="flyer">Seleccionar archivo</label>
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block mt-3">Crear</button>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript"
          src="{!! asset('js/init_datetimepickers.js') !!}"></script>

  <script type="text/javascript"
          src="{!! asset('js/init_flyer_filechooser.js') !!}"></script>
@append
