<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>@yield('page-title')</title>
  @yield('stylesheets')
</head>

<body class="bg-dark">
<div class="container">
  <div class="card {{$card_type}} mx-auto mt-5">
    <div class="card-header">{{$card_title}}</div>
    <div class="card-body">
      @if(session('info'))
        <div class="alert alert-info">
          <strong>{{session('info')}}</strong>
        </div>
      @endif

      @if(count($errors))
        <div class="alert alert-danger">
          <strong>Ocurrieron los siguientes errores:</strong>
          <ul>
            @foreach($errors as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @yield('content')
    </div>
  </div>
</div>

@section('scripts')
  @include('imports.js_libs')
@endsection

</body>

</html>
