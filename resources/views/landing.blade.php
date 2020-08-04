@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row">
        <div id="test"></div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Masuk Seleksi Online</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{url('seleksi')}}">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Masukkan alamat email saat mendaftar" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Masuk
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<footer class="navbar-default navbar-fixed-bottom">
    <div class="container text-center" style="margin-top: 7px;">
        <h5><strong>Copyright &copy; 2020 BBPLK Bekasi.</strong></h5>
    </div>
</footer>
@endsection

@section('script')
    <script>
        $('button[type="submit"]').on('click', function(event) {
        })
    </script>
@endsection