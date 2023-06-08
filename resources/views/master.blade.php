<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no"
        name="viewport">

  <title>@yield('page-title')</title>
  @yield('stylesheets')
</head>

<body id="page-top">

@include('components.navbar')

<div id="wrapper">

  @include('components.sidebar')

  <div id="content-wrapper">
    <div class="container-fluid">
      @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
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

@include('components.scroll-top-button')
@include('imports.js_libs')
@yield('scripts')
<script type="text/javascript"
        src="{!! asset('js/close_info_alert.js')!!}"></script>

</body>

</html>

