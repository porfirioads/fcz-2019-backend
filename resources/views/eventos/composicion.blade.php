@extends('master', ['sd_ini_cl' => '', 'sd_eve_cl' => 'active',
  'sd_usu_cl' => '', 'sd_cat_cl' => '', 'sd_ins_cl' => ''])

@section('page-title')
  Programa de evento
@endsection

@section('stylesheets')
  @include('imports.stylesheets')
@endsection

@section('content')
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-calendar"></i>
      Programa de <a href="{{route('event.details.view', ['id' => $congreso->id])}}">
        {{$congreso->nombre}}
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
          <tr>
            <th>Nombre</th>
            <th>Acciones</th>
          </tr>
          </thead>
          <tbody>
          @foreach($subeventos as $subevento)
            <form method="post"
                  action="{{ route('event.schedule.remove.action', ['id' => $congreso->id]) }}"
                  novalidate enctype="multipart/form-data">
              @csrf
              {!! method_field('delete') !!}
              <tr>
                <td>{{$subevento->nombre}}</td>
                <td>
                  <input type="hidden" id="child_event_id" name="child_event_id"
                         value="{{$subevento->id}}">
                  <button class="btn btn-danger text-white" data-toggle="tooltip"
                          title="Eliminar" type="submit">
                    <i class="fas fa-fw fa-eraser"></i>
                  </button>
                </td>
              </tr>
            </form>
          @endforeach
          <tr>
            <form method="post"
                  action="{{ route('event.schedule.add.action', ['id' => $congreso->id]) }}"
                  novalidate enctype="multipart/form-data">
              @csrf
              <td>
                <div class="form-group">
                  <select id="child_event_id" name="child_event_id" class="form-control">
                    <option disabled selected></option>
                    @foreach($subeventos_candidatos as $subevento)
                      <option value="{{$subevento->id}}">
                        {{$subevento->nombre}}
                      </option>
                    @endforeach
                  </select>
                </div>
              </td>
              <td>
                <button class="btn btn-primary text-white" data-toggle="tooltip"
                        type="submit" title="Agregar">
                  <i class="fas fa-fw fa-check"></i>
                </button>
              </td>
            </form>
          </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript"
          src="{!! asset('js/init_datetimepickers.js') !!}"></script>

  <script type="text/javascript"
          src="{!! asset('js/init_flyer_filechooser.js') !!}"></script>
@append
