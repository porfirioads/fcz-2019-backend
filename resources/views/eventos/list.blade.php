@extends('master', ['sd_eve_cl' => 'active', 'sd_cat_cl' => ''])

@section('page-title')
  Eventos
@endsection

@section('stylesheets')
  @include('imports.stylesheets')
@endsection

@section('content')
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-calendar"></i>
      Eventos
    </div>
    <div class="card-body">
      @if(session('UserLogged'))
        <a class="btn btn-block btn-primary text-white mb-3" href="{{route('evento.create.view')}}">
          Nuevo evento
          <i class="fas fa-fw fa-plus"></i>
        </a>
      @endif
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
          <tr>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Tarjeta frontal</th>
            <th>Tarjeta trasera</th>
            <th>Acciones</th>
          </tr>
          </thead>
          <tbody>
          @foreach($eventos as $evento)
            <tr>
              <td>
                {{$evento->nombre}}
              </td>
              <td>
                {{$evento->fecha}}
              </td>
              <td class="">
                <img id="flyer" class="img-thumbnail small"
                     src="{{asset("$evento->tarjeta_frontal")}}"
                     alt="{{$evento->nombre}}">
              </td>
              <td>
                <img id="flyer" class="img-thumbnail small"
                     src="{{asset("$evento->tarjeta_trasera")}}"
                     alt="{{$evento->nombre}}">
              </td>
              <td>
                <a class="btn btn-sm btn-success text-white"
                   href="{{ route('evento.edit.view', ['evento_id' => $evento->id]) }}">
                  <i class="fa fa-edit"></i>
                </a>
                <button type="button" class="btn btn-sm btn-danger btnDeleteEvento"
                        data-toggle="modal" data-target="#modalEliminacionEvento"
                        data-eventoid="{{$evento->id}}">
                  <i class="fa fa-times"></i>
                </button>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div id="modalEliminacionEvento" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Eliminar evento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Seguro de que deseas eliminar el evento?</p>
        </div>
        <div class="modal-footer">
          <form method="post" action="{{ route('evento.delete.action')}}" novalidate
                enctype="multipart/form-data">
            @csrf
            <input name="evento_id" id="evento_id" type="hidden">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript"
          src="{!! asset('js/demo/datatables-demo.js')!!}"></script>

  <script type="text/javascript">
    $('.btnDeleteEvento').click(function () {
      $('#evento_id').val($(this).data('eventoid'));
    });
  </script>
@append

