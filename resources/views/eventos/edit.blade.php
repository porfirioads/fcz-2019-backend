@extends('master', ['sd_ini_cl' => '', 'sd_eve_cl' => 'active',
  'sd_usu_cl' => '', 'sd_cat_cl' => '', 'sd_ins_cl' => ''])

@section('page-title')
  Editar evento
@endsection

@section('stylesheets')
  @include('imports.stylesheets')
@endsection

@section('content')
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-calendar"></i>
      Editar evento ({{$evento->nombre}})
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('evento.edit.action', ['evento_id' => $evento->id]) }}" novalidate
            enctype="multipart/form-data">
        @csrf

        <div class="row">
          <div class="col-md-6 col-sm-12">

            <div class="form-group">
              <label for="nombre" class="placeholder-hidden-label">Nombre</label>
              <input type="text" id="nombre" name="nombre" class="form-control"
                     autofocus="autofocus"
                     value="{{old('nombre', $evento->nombre)}}">
            </div>

            <div class="form-group">
              <label for="fecha" class="placeholder-hidden-label">Fecha</label>
              <input type="text" class="form-control datetimepicker-input" id="fecha"
                     name="fecha"
                     data-toggle="datetimepicker" data-target="#fecha"
                     value="{{old('fecha', $evento->fecha)}}" autocomplete="off"/>
            </div>

            <div class="form-row">
              <div class="col-md-2 col-sm-12">
                <img class="img-thumbnail" src="{{asset("$evento->tarjeta_frontal")}}">
              </div>

              <div class="col-md-10 col-sm-12">
                <div class="form-group">
                  <label for="tarjeta_frontal" class="placeholder-hidden-label">Tarjeta frontal</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="tarjeta_frontal" name="tarjeta_frontal">
                    <label class="custom-file-label" for="tarjeta_frontal">Seleccionar archivo</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-2 col-sm-12">
                <img class="img-thumbnail" src="{{asset("$evento->tarjeta_trasera")}}">
              </div>

              <div class="col-md-10 col-sm-12">
                <div class="form-group">
                  <label for="tarjeta_trasera" class="placeholder-hidden-label">Tarjeta trasera</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="tarjeta_trasera" name="tarjeta_trasera">
                    <label class="custom-file-label" for="tarjeta_trasera">Seleccionar archivo</label>
                  </div>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-3">Actualizar</button>
          </div>

          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label for="categorias" class="placeholder-hidden-label">Categorías</label>

              <select id="categorias" name="categorias[]" class="form-control" size="25" multiple="multiple">
                @foreach($categorias as $categoria)
                  <option value="{{$categoria->id}}"
                          @if(in_array($categoria->id, $categorias_seleccionadas))selected="selected"@endif>
                    {{$categoria->nombre}}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
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
