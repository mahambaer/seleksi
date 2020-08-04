@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Kirim E-mail</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {!! session('status') !!}
                        </div>
                    @endif
                    <div class="no-padding">
                        <form id="form_peserta" action="{{ action('PesertaController@tokenLinkSendRequest') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="program_id">Program Pelatihan</label>
                                <select name="program_id" id="program_id" class="form-control">
                                    @foreach ($programs as $program)
                                        <option value="{{$program->id}}">{{$program->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">SEND MAIL</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">List Peserta</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {!! session('status') !!}
                        </div>
                    @endif
                    <div class="no-padding">
                        <form id="form_import" action="{{ action('PesertaController@importExcel') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group{{ $errors->has('excel') ? ' has-error' : '' }}">
                                <label for="excel">File Excel</label>
                                <input type="file" name="excel" id="excel" class="form-control">
                                @if ($errors->has('excel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('excel') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">IMPORT</button>
                        </form>
                    </div>
                    <hr>
                    <div class="no-padding">
                        <table id="peserta" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Judul Program</th>
                                    <th>Waktu Pengerjaan</th>
                                    <th>Score</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesertas as $peserta)
                                    <tr>
                                        <td>{{$peserta->name}}</td>
                                        <td>{{$peserta->email}}</td>
                                        <td>{{$peserta->program->name}}</td>
                                        <td>{{$peserta->durasi}}</td>
                                        <td>{{$peserta->score}}</td>
                                        <td>{{$peserta->status}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')    
<script>
    $('#peserta').DataTable({
        'paging'          : true,
        'lengthChange'    : true,
        'searching'       : true,
        'ordering'        : true,
        'info'            : true,
        'autoWidth'       : false,
        'scrollX'         : true,
        'pageLength'      : 50
    });

    $(document).ready(function(){
        $('button[type="submit"]').on('click', function(){
            $('#exampleModalCenter').modal('show')
        })
    })
</script>
@endsection
