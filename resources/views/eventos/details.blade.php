@extends('master', ['sd_ini_cl' => '', 'sd_eve_cl' => 'active',
  'sd_usu_cl' => '', 'sd_cat_cl' => '', 'sd_ins_cl' => ''])

@section('page-title')
  Detalle de evento
@endsection

@section('stylesheets')
  @include('imports.stylesheets')
@endsection

@section('content')
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-calendar"></i>
      Detalle de evento
      @if(session('UserLogged'))
        @if(session('IsAdmin'))
          <a href="{{route('event.edit.view', ['id' => $evento->id])}}">
            (editar)
          </a>
        @endif
      @endif
    </div>
    <div class="card-body">
      <div class="form-group">
        <div class="form-group">
          <label for="nombre" class="placeholder-hidden-label">Nombre</label>
          <input id="nombre" type="text" class="form-control"
                 value="{{$evento->nombre}}" readonly>
        </div>
      </div>

      <div class="form-row">
        <div class="col-sm-4">
          <div class="form-group">
            <label for="fecha_inicio" class="placeholder-hidden-label">Fecha de inicio</label>
            <input id="fecha_inicio" type="text" class="form-control"
                   value="{{$evento->fecha_inicio}}" readonly/>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            <label for="fecha_fin" class="placeholder-hidden-label">Fecha de fin</label>
            <input id="fecha_fin" type="text" class="form-control"
                   value="{{$evento->fecha_fin}}" readonly/>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            <label for="tipo" class="placeholder-hidden-label">Tipo de evento</label>
            <input id="tipo" type="text" class="form-control"
                   value="{{$tipos_evento[$evento->tipo]}}" readonly/>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="descripcion" class="placeholder-hidden-label">Descripción</label>
        <textarea id="descripcion" class="form-control" rows="5"
                  readonly>{{$evento->descripcion}}</textarea>
      </div>

      <div class="form-group">
        <label for="flyer" class="placeholder-hidden-label">Flyer</label>
        <img id="flyer" class="img-fluid img-thumbnail mw-100"
             src="{{asset("$evento->flyer")}}"
             alt="{{$evento->nombre}}">
      </div>

      @if($evento->tipo === 'CONGRE')
        <h6 class="font-weight-bold">
          Talleres/conferencias ({{count($subeventos)}})
          @if(session('UserLogged'))
            @if(session('IsAdmin'))
              <a href="{{route('event.schedule.view', ['id' => $evento->id])}}">
                (editar)
              </a>
            @endif
          @endif
        </h6>

        @foreach($subeventos as $subevento)
          <a class="btn btn-primary text-white"
             href="{{route('event.details.view', ['id' => $subevento->id])}}">
            {{$subevento->nombre}}
          </a>
        @endforeach
      @elseif($evento->has_evento_padre)
        <h6 class="font-weight-bold">Congreso</h6>
        <a class="btn btn-primary text-white"
           href="{{route('event.details.view', ['id' => $evento_padre->id])}}">
          {{$evento_padre->nombre}}
        </a>
      @endif

      @if(session('UserLogged'))
        <h6 class="font-weight-bold mt-3">
          Acciones
        </h6>

        @if($inscrito)
          <form method="post"
                action="{{route('subscription.remove.action', ['id' => $evento->id])}}"
                novalidate enctype="multipart/form-data">
            @csrf
            <button type="submit" class="btn btn-warning text-white">
              Desinscribirse
            </button>
          </form>
        @else
          <form method="post" action="{{route('subscription.add.action', ['id' => $evento->id])}}"
                novalidate enctype="multipart/form-data">
            @csrf
            <button type="submit" class="btn btn-success text-white">
              Inscribirse
            </button>
          </form>
        @endif
      @endif
    </div>
@endsection
