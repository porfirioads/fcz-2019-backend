@extends('master', ['sd_ini_cl' => '', 'sd_eve_cl' => '',
  'sd_usu_cl' => 'active', 'sd_cat_cl' => '', 'sd_ins_cl' => ''])

@section('page-title')
  Asistentes
@endsection

@section('stylesheets')
  @include('imports.stylesheets')
@endsection

@section('content')
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-users"></i>
      Asistentes
    </div>
    <div class="card-body">
      <div id="accordion">
        @foreach($congresos_con_subeventos as $congresoId => $congresoConSubeventos)
          <div class="card">
            <div class="card-header" id="heading{{$congresoId}}">
              <h5 class="mb-0">
                <button class="btn btn-danger print-button" data-event_id="{{$congresoId}}">
                  <i class="fa fa-file-pdf"></i>
                </button>
                <button class="btn btn-link text-dark font-weight-bold" data-toggle="collapse"
                        data-target="#collapse{{$congresoId}}"
                        aria-expanded="true" aria-controls="collapse{{$congresoId}}">
                  {{$congresoConSubeventos['congreso']->nombre}}
                </button>
              </h5>
            </div>

            <div id="collapse{{$congresoId}}" class="collapse"
                 aria-labelledby="heading{{$congresoId}}"
                 data-parent="#accordion">
              <div class="card-body p-1">
                <div class="table-responsive">
                  <table class="table">
                    @if(count($participantes_por_evento[$congresoId]))
                      <thead class="thead-dark">
                      <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Acciones</th>
                      </tr>
                      </thead>
                    @else
                      <tr>
                        <td colspan="3">
                          No hay asistentes registrados
                        </td>
                      </tr>
                    @endif
                    <tbody>
                    @foreach($participantes_por_evento[$congresoId] as $participante)
                      <tr>
                        <td>
                          {{$participante->nombre}}
                          {{$participante->primer_apellido}}
                          {{$participante->segundo_apellido}}
                        </td>
                        <td>{{$participante->tipo_asistencia}}</td>
                        <td>
                          @if($participante->estatus_asistencia === "Confirmado")
                            <form method="post" action="{{route('participant.refuse.action')}}"
                                  novalidate enctype="multipart/form-data" class="d-inline">
                              @csrf
                              <input type="hidden" name="user_id" value="{{$participante->id}}">
                              <input type="hidden" name="event_id" value="{{$congresoId}}">
                              <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                      title="Denegar asistencia">
                                <i class="fa fa-times"></i>
                              </button>
                            </form>
                          @else
                            <form method="post" action="{{route('participant.confirm.action')}}"
                                  novalidate enctype="multipart/form-data" class="d-inline">
                              @csrf
                              <input type="hidden" name="user_id" value="{{$participante->id}}">
                              <input type="hidden" name="event_id" value="{{$congresoId}}">
                              <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip"
                                      title="Confirmar asistencia">
                                <i class="fa fa-check"></i>
                              </button>
                            </form>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>

                <hr>

                @foreach($congresoConSubeventos['subeventos'] as $subevento)
                  <div class="table-responsive">
                    <table class="table">
                      <tr class="bg-dark text-white">
                        <th colspan="3">
                          {{$subevento->nombre}}
                        </th>
                      </tr>
                      @if(count($participantes_por_evento[$subevento->id]))
                        <tr class="bg-secondary text-white">
                          <th scope="col">Nombre</th>
                          <th scope="col">Tipo</th>
                          <th scope="col">Acciones</th>
                        </tr>
                        @foreach($participantes_por_evento[$subevento->id] as $participante)
                          <tr>
                            <td>
                              {{$participante->nombre}}
                              {{$participante->primer_apellido}}
                              {{$participante->segundo_apellido}}
                            </td>
                            <td>{{$participante->tipo_asistencia}}</td>
                            <td>
                              @if($participante->estatus_asistencia === "Confirmado")
                                <form method="post" action="{{route('participant.refuse.action')}}"
                                      novalidate enctype="multipart/form-data" class="d-inline">
                                  @csrf
                                  <input type="hidden" name="user_id" value="{{$participante->id}}">
                                  <input type="hidden" name="event_id" value="{{$subevento->id}}">
                                  <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                          title="Denegar asistencia">
                                    <i class="fa fa-times"></i>
                                  </button>
                                </form>
                              @else
                                <form method="post" action="{{route('participant.confirm.action')}}"
                                      novalidate enctype="multipart/form-data" class="d-inline">
                                  @csrf
                                  <input type="hidden" name="user_id" value="{{$participante->id}}">
                                  <input type="hidden" name="event_id" value="{{$subevento->id}}">
                                  <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip"
                                          title="Confirmar asistencia">
                                    <i class="fa fa-check"></i>
                                  </button>
                                </form>
                              @endif
                            </td>
                          </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="3">
                            No hay asistentes registrados
                          </td>
                        </tr>
                      @endif
                    </table>
                  </div>
                  <hr>
                @endforeach
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <div id="printableContainer" class="d-none">
    @foreach($congresos_con_subeventos as $congresoId => $congresoConSubeventos)
      <div id="printable{{$congresoId}}">
        <h1>
          Asistentes de {{$congresoConSubeventos['congreso']->nombre}}
        </h1>

        <table>
          <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Tipo</th>
          </tr>
          </thead>
          <tbody>
          @foreach($participantes_por_evento[$congresoId] as $indexKey => $participante)
            @if($participante->estatus_asistencia === "Confirmado")
              <tr>
                <td>{{$indexKey + 1}}</td>
                <td>
                  {{$participante->nombre}}
                  {{$participante->primer_apellido}}
                  {{$participante->segundo_apellido}}
                </td>
                <td>{{$participante->tipo_asistencia}}</td>
              </tr>
            @endif
          @endforeach
          </tbody>
        </table>

        @foreach($congresoConSubeventos['subeventos'] as $subevento)
          <h3>{{$subevento->nombre}}</h3>

          <table>
            <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Tipo</th>
            </tr>
            </thead>
            <tbody>
            @foreach($participantes_por_evento[$subevento->id] as $indexKey => $participante)
              @if($participante->estatus_asistencia === "Confirmado")
                <tr>
                  <td>{{$indexKey + 1}}</td>
                  <td>
                    {{$participante->nombre}}
                    {{$participante->primer_apellido}}
                    {{$participante->segundo_apellido}}
                  </td>
                  <td>{{$participante->tipo_asistencia}}</td>
                </tr>
              @endif
            @endforeach
            </tbody>
          </table>
        @endforeach
      </div>
    @endforeach
  </div>

  <div class="modal fade" id="confirmEventDeleteModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Eliminar evento</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <form method="post" action=""
              novalidate
              enctype="multipart/form-data">

          @csrf
          {!! method_field('delete') !!}

          <div class="modal-body">
            ¿Seguro que deseas eliminar el evento?
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Eliminar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript"
          src="{!! asset('js/demo/datatables-demo.js')!!}"></script>
  <script type="text/javascript"
          src="{!! asset('js/form_delete_event.js') !!}"></script>

  <script>
    $('.print-button').click(function () {
      var eventId = $(this).data('event_id');
      var htmlToPrint = '<!DOCTYPE html>' +
        '<html lang="en">' +
        '<head>' +
        '<meta charset="utf-8">' +
        '<meta http-equiv="X-UA-Compatible" content="IE=edge">' +
        '<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">' +
        '<style>' +
        '{{str_replace("\n", "", file_get_contents('css/print.css'))}}' +
        '</style>' +
        '</head>' +
        '<body>' +
        $(`#printable${eventId}`).html() +
        '</body>' +
        '</html>';

      var newWin = window.open("");
      newWin.document.write(htmlToPrint);
      newWin.print();
      newWin.close();
    })
  </script>
@append

