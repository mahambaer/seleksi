<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('/plugins/dataTables.bootstrap.css')}}"/>
    @yield('style')
</head>
<body>
    <div id="app">
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog" role="document" style="position: absolute; top: 50%; width: 100%">
            <div class="hollow-dots-spinner" style="margin: 0 auto">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
          </div>
        </div>
        <nav class="navbar navbar-default {{Request::is('mulai*') ? 'navbar-fixed-top' : 'navbar-static-top'}}">
            <div class="container" style="padding-right: 0;">
                <div class="navbar-header" style="width: 100%;">

                    <!-- Collapsed Hamburger -->
                    {{-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button> --}}

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{!Request::is('mulai*') ? url('seleksi') : 'javascript:void(0)'}}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    @if (Request::is('mulai*'))
                    <div class="pull-right" style="margin-top: 7px" >
                        <span class="h3" style="margin: 0; margin-right: 10px; padding: 0px" id="timer"></span>
                        <form class="form-inline pull-right">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <input type="hidden" id="durasi" value="{{$peserta->program->durasi}}">
                            {{-- <input type="hidden" id="token" value="{{$peserta->token}}"> --}}
                            <input type="hidden" id="email" value="{{$peserta->email}}">
                            <input type="hidden" id="id" value="{{$peserta->id}}">
                            <input type="hidden" id="jumlah_soal" value="{{$peserta->program->soals->count()}}">
                            <button type="button" class="btn btn-primary" id="kirim" disabled><i class="glyphicon glyphicon-send"></i>&nbsp;&nbsp;KIRIM</button>
                        </form>
                    </div>
                    @endif
                </div>
{{-- 
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                    </ul>
                </div> --}}
            </div>
        </nav>

        @yield('content')

        @yield('footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
