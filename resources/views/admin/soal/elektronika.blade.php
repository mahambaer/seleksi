@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Soal Elektronika</div>

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
                    <form id="form_soal" action="{{ action('SoalController@storeElektronika') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="text-bold">{{ trans('form.soal_pertanyaan') }}</label>
                            <textarea class="form-control" name="pertanyaan" id="pertanyaan" cols="30" rows="5" placeholder="">{{ old('pertanyaan') }}</textarea>
                        </div>
                        <div class="form-group" >
                            <label class="text-bold">Pilihan yang Benar</label>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label type="button" class="btn btn-default btn-flat active">
                                    <input type="radio" name="status" id="status1" class="radio-inline jawaban" checked autocomplete="off" value="pilihan1"/>
                                    {{ trans('form.jawaban_1') }}
                                </label>
                                <label type="button" class="btn btn-default btn-flat ">
                                    <input type="radio" name="status" id="status2" class="radio-inline jawaban" autocomplete="off" value="pilihan2"/>
                                    {{ trans('form.jawaban_2') }}
                                </label>
                                <label type="button" class="btn btn-default btn-flat ">
                                    <input type="radio" name="status" id="status3" class="radio-inline jawaban" autocomplete="off" value="pilihan3"/>
                                    {{ trans('form.jawaban_3') }}
                                </label>
                                <label type="button" class="btn btn-default btn-flat ">
                                    <input type="radio" name="status" id="status4" class="radio-inline jawaban" autocomplete="off" value="pilihan4"/>
                                    {{ trans('form.jawaban_4') }}
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-bold">{{ trans('form.jawaban_1') }}</label>
                            <textarea class="form-control" name="pilihan1" id="pilihan1" cols="30" rows="3" placeholder="">{{ old('pilihan1') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="text-bold">{{ trans('form.jawaban_2') }}</label>
                            <textarea class="form-control" name="pilihan2" id="pilihan2" cols="30" rows="3" placeholder="">{{ old('pilihan2') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="text-bold">{{ trans('form.jawaban_3') }}</label>
                            <textarea class="form-control" name="pilihan3" id="pilihan3" cols="30" rows="3" placeholder="">{{ old('pilihan3') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="text-bold">{{ trans('form.jawaban_4') }}</label>
                            <textarea class="form-control" name="pilihan4" id="pilihan4" cols="30" rows="3" placeholder="">{{ old('pilihan4') }}</textarea>
                        </div>
                        @component('component.btn-submit')
                            
                        @endcomponent
                    </form>
                </div>
            </div>
        </div>
        {{-- list soal --}}
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Soal Elektronika : {{$soals->count()}} Soal</div>

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
                                            <form action="{{url('soal/elektronika/'.$soal->id)}}" style="display:inline-block" method="POST">
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
                                            <div class="panel {{$jawaban->status == 'benar' ? 'panel-primary' : 'panel-info'}}">
                                                <div class="panel-heading">
                                                    <div class="row">
                                                        <h5 class="col-xs-11 panel-title" style="margin-top: 3px">
                                                            <b>Pilihan {{$index2}}</b>
                                                        </h5>
                                                        @if ($jawaban->status == 'benar')
                                                        <div class="col-xs-1">
                                                            <button class="btn btn-success btn-xs"><i class="glyphicon glyphicon-ok"></i></button>
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
        if($('#pertanyaan').length)
        {
              CKEDITOR.replace('pertanyaan', {
                    filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token()])}}",
                    filebrowserUploadMethod: 'form',
                    height: 100
              });
        }
        if($('#pilihan1').length)
        {
              CKEDITOR.replace('pilihan1', {
                    filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token()])}}",
                    filebrowserUploadMethod: 'form',
                    height: 100
              });
        }
        if($('#pilihan2').length)
        {
              CKEDITOR.replace('pilihan2', {
                    filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token()])}}",
                    filebrowserUploadMethod: 'form',
                    height: 100
              });
        }
        if($('#pilihan3').length)
        {
              CKEDITOR.replace('pilihan3', {
                    filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token()])}}",
                    filebrowserUploadMethod: 'form',
                    height: 100
              });
        }
        if($('#pilihan4').length)
        {
              CKEDITOR.replace('pilihan4', {
                    filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token()])}}",
                    filebrowserUploadMethod: 'form',
                    height: 100
              });
        }
        $(document).ready(function(){
            $('.collapse').on('shown.bs.collapse', function() {
                var button = $(this) 
                var id = button.data('soal')
                var element = document.getElementById(id)
                element.scrollIntoView()
            })
        })
    </script>
@endsection
