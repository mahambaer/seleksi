@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Soal Pariwisata</div>

                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Terdapat kesalahan pada form yang Anda isi<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="form_soal" action="{{ action('SoalController@storePariwisata') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="text-bold">{{ trans('form.soal_pertanyaan') }}</label>
                            <textarea class="form-control" name="pertanyaan" id="pertanyaan" cols="30" rows="5" placeholder="">{{ old('pertanyaan') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">{{trans('form.jumlah_pilihan')}}</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" max="5" min="2" value="{{ old('jumlah') }}">
                        </div>
                        <div class="form-group">
                            <label for="tipe">{{trans('form.tipe_pilihan')}}</label>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons" id="tipe">
                                <label type="button" class="btn btn-default btn-flat active">
                                    <input type="radio" name="tipe" id="benar" class="radio-inline jawaban" checked autocomplete="off" value="benar"/>
                                    {{trans('form.tipe_benar')}}
                                </label>
                                <label type="button" class="btn btn-default btn-flat">
                                    <input type="radio" name="tipe" id="score" class="radio-inline jawaban" autocomplete="off" value="score"/>
                                    {{trans('form.tipe_score')}}
                                </label>
                            </div>
                        </div>
                        <div class="form-group" id="pilihan-benar">
                            <label class="text-bold">Pilihan yang Benar</label>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons" id="pilihan">
                            </div>
                        </div>
                        <div class="form-group" id="pilihan-score">
                            <label class="text-bold">Score</label>
                            <div class="input-group" style="width: 100%" id="nilai-score">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat pull-right submit" id="submit-soal">{{ trans('form.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- list soal --}}
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Soal Pariwisata : {{$soals->count()}} Soal</div>

                <div class="panel-body">
                    <div class="panel-group" id="soals">
                        @php
                            $index = 1;
                        @endphp
                        @foreach ($soals as $soal)
                            <div class="panel panel-danger" id="toggle{{$index}}">
                                <div class="panel-heading" id="headingSoal{{$index}}">
                                    <div class="row">
                                        <h4 class="col-xs-11 panel-title" style="margin-top: 3px">
                                            <p class="panel-title" role="button" data-toggle="collapse" data-target="#soal{{$index}}" aria-expanded="true" aria-controls="soal{{$index}}">
                                                <b>Soal {{$index}}</b>
                                            </p>
                                        </h5>
                                        <div class="col-xs-1">
                                            <form action="{{url('soal/pariwisata/'.$soal->id)}}" style="display:inline-block" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" title="Hapus" class="btn btn-danger btn-xs remove" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i>"><i class="glyphicon glyphicon-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="soal{{$index}}" data-soal="toggle{{$index}}" class="collapse" aria-labelledby="headingSoal{{$index}}" data-parent="#soals">
                                    <div class="panel-body">
                                        @php
                                            $result = Storage::disk('public')->get($soal->link);
                                            $result = substr($result, 3);
                                            $result = substr($result, 0, -4);
                                        @endphp
                                        <div class="col-xs-12" style="overflow-x: auto; max-height: 300px">
                                           <b>{!! $result !!}</b> 
                                        </div>
                                    </div>
                                    <div class="panel-group" id="jawabans{{$index}}">
                                        @php
                                            $index2 = 1;
                                        @endphp
                                        @foreach ($soal->jawabans as $jawaban)
                                            <div class="panel {{$jawaban->tipe == 'benar' && $jawaban->status == 1 ? 'panel-primary' : 'panel-info'}}">
                                                <div class="panel-heading">
                                                    <div class="row">
                                                        <h5 class="col-xs-11 panel-title" style="margin-top: 3px">
                                                            <b>Pilihan {{$index2}}</b>
                                                        </h5>
                                                        @if ($jawaban->tipe == 'benar' && $jawaban->status == 1)
                                                        <div class="col-xs-1">
                                                            <button class="btn btn-success btn-xs"><i class="glyphicon glyphicon-ok"></i></button>
                                                        </div>
                                                        @elseif ($jawaban->tipe == 'score')
                                                        <div class="col-xs-1">
                                                            <button class="btn btn-success btn-xs">{{$jawaban->status}}</button>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    @php
                                                        $result = Storage::disk('public')->get($jawaban->link);
                                                        $result = substr($result, 3);
                                                        $result = substr($result, 0, -4);
                                                    @endphp
                                                    <div class="col-xs-12" style="overflow-x: auto; max-height: 300px">
                                                       <b>{!! $result !!}</b> 
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $index2++;
                                            @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @php
                                $index++;
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        var jumlah = $('#jumlah').val()
        $(document).ready(function(){
            $('#pilihan-score').toggle()
            if(jumlah == '')
            {
                jumlah = 4
                $('#jumlah').val(jumlah)
            }

            var pilihan = $('#pilihan')
            var nilaiScore = $('#nilai-score')
            for(var index = 1; index <= jumlah; index++){
                    pilihan.append(`
                                <label type="button" class="btn btn-default btn-flat ${index == 1 ? 'active' : ''}">
                                    <input type="radio" name="status" id="status${index}" class="radio-inline jawaban" ${index == 1 ? 'checked' : ''} autocomplete="off" value="pilihan${index}"/>
                                    Pilihan ${index}
                                </label>
                                `)
                    $('#submit-soal').before(`
                        <div class="form-group form-jawaban">
                            <label class="text-bold">Pilihan ${index}</label>
                            <textarea class="form-control" name="pilihan${index}" id="pilihan${index}" cols="30" rows="3" placeholder=""></textarea>
                        </div>
                    `)
                    nilaiScore.append(`
                        <input type="number" class="form-control score" name="score${index}" id="score${index}" placeholder="Pilihan ${index}" max="${jumlah}" min="1">
                    `)
                    CKEDITOR.replace(`pilihan${index}`, {
                        filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token()])}}",
                        filebrowserUploadMethod: 'form',
                        height: 100
                    })
                }
            
            if($('#pertanyaan').length)
            {
              CKEDITOR.replace('pertanyaan', {
                    filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token()])}}",
                    filebrowserUploadMethod: 'form',
                    height: 100
              });
            }

            $('input[name="tipe"]').on('change', function(){
                $('#pilihan-benar').toggle()
                $('#pilihan-score').toggle()
            })

            $('#jumlah').on('change', function() {
                jumlah = $(this).val()
                var formJawaban = $('.form-jawaban')
                formJawaban.remove()
                var scores = $('.score')
                scores.remove()
                pilihan.empty()
                for(var index = 1; index <= jumlah; index++){
                    pilihan.append(`
                                <label type="button" class="btn btn-default btn-flat ${index == 1 ? 'active' : ''}">
                                    <input type="radio" name="status" id="status${index}" class="radio-inline jawaban" ${index == 1 ? 'checked' : ''} autocomplete="off" value="pilihan${index}"/>
                                    Pilihan ${index}
                                </label>
                                `)
                    nilaiScore.append(`
                        <input type="number" class="form-control score" name="score${index}" id="score${index}" placeholder="Pilihan ${index}" max="${jumlah}" min="1">
                    `)
                    $('#submit-soal').before(`
                        <div class="form-group form-jawaban">
                            <label class="text-bold">Pilihan ${index}</label>
                            <textarea class="form-control-static" style="width: 100%" name="pilihan${index}" id="pilihan${index}" cols="30" rows="3" placeholder=""></textarea>
                        </div>
                    `)
                    CKEDITOR.replace(`pilihan${index}`, {
                        filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token()])}}",
                        filebrowserUploadMethod: 'form',
                        height: 100
                    })
                }
            })

            $('.collapse').on('shown.bs.collapse', function() {
                var button = $(this) 
                var id = button.data('soal')
                var element = document.getElementById(id)
                element.scrollIntoView()
            })

            
        })
    </script>
@endsection
