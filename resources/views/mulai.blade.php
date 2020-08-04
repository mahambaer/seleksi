@extends('layouts.test')

@section('style')
<style>
#app {
    display: none
}
.hollow-dots-spinner, .hollow-dots-spinner * {
  box-sizing: border-box;
}

.hollow-dots-spinner {
  height: 15px;
  width: calc(30px * 3);
}

.hollow-dots-spinner .dot {
  width: 15px;
  height: 15px;
  margin: 0 calc(15px / 2);
  border: calc(15px / 5) solid #ff1d5e;
  border-radius: 50%;
  float: left;
  transform: scale(0);
  animation: hollow-dots-spinner-animation 1000ms ease infinite 0ms;
}

.hollow-dots-spinner .dot:nth-child(1) {
  animation-delay: calc(300ms * 1);
}

.hollow-dots-spinner .dot:nth-child(2) {
  animation-delay: calc(300ms * 2);
}

.hollow-dots-spinner .dot:nth-child(3) {
  animation-delay: calc(300ms * 3);

}

@keyframes hollow-dots-spinner-animation {
  50% {
    transform: scale(1);
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
</style>
@endsection

@section('content')
<div class="container" style="padding-top: 55px">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel-group" id="soals">
                @php
                    $index = 1;
                    $shuffled = $peserta->program->soals->shuffle();
                @endphp
                @foreach ($shuffled as $soal)
                <div class="panel panel-primary" id="toggle{{$index}}">
                    <div class="panel-heading" id="headingSoal{{$index}}" role="button" data-toggle="collapse" data-target="#soal{{$index}}" aria-controls="soal{{$index}}">
                        <h4 class="panel-title" style="margin-top: 3px">
                            <p class="panel-title">
                                <b>Soal Nomor {{$index}} : <span id="pilihan{{$index}}"></span></b>
                            </p>
                        </h4>
                    </div>
                    <div id="soal{{$index}}" data-soal="#toggle{{$index}}" class="collapse {{$index == 1 ? 'in' : ''}}" aria-labelledby="headingSoal{{$index}}" data-parent="#soals">
                        <div class="panel-body">
                            @php
                                $result = Storage::disk('public')->get($soal->link);
                                $result = substr($result, 3);
                                $result = substr($result, 0, -4);
                            @endphp
                            <div style="overflow-x: auto; max-height: 300px">
                               <h4><b>{!! $result !!}</b></h4> 
                               <hr>
                            </div>
                            <div class="btn-group-toggle row" data-toggle="buttons">
                                @php
                                    $index2 = 1;
                                    $shuffled2 = $soal->jawabans->shuffle();
                                @endphp
                                @foreach ($shuffled2 as $jawaban)
                                <label type="button" class="btn btn-default col-xs-12" style="border-radius: 0; border-width: 0">
                                    <input type="radio" name="jawabans[]" data-jawaban="{{$index2}}" data-soal="{{$index}}" id="soal{{$index}}-jawaban{{$index2}}" class="radio-inline jawaban" autocomplete="off" value="{{$jawaban->id}}"/>
                                    @php
                                        $result = Storage::disk('public')->get($jawaban->link);
                                        $result = substr($result, 3);
                                        $result = substr($result, 0, -4);
                                    @endphp
                                    <h5 class="col-xs-12 text-left" style="overflow-x: auto; max-height: 300px">
                                       <b>
                                            @if ($index2 == 1)
                                                A.&nbsp;
                                            @elseif ($index2 == 2)
                                                B.&nbsp;
                                            @elseif ($index2 == 3)
                                                C.&nbsp;
                                            @else
                                                D.&nbsp;
                                            @endif
                                            {!! $result !!}
                                        </b> 
                                    </h5>
                                </label>
                                @php
                                    $index2++;
                                @endphp
                                @endforeach
                            </div>
                            <hr>
                            <div class="btn-group pull-right">
                                @if ($index != 1)
                                <button class="btn btn-success"><i class="glyphicon glyphicon-chevron-left" data-toggle="collapse" data-target="#soal{{$index-1}}" aria-controls="soal{{$index-1}}"></i></button>
                                @endif
                                @if ($index != $peserta->program->soals->count())
                                <button class="btn btn-success"><i class="glyphicon glyphicon-chevron-right"data-toggle="collapse" data-target="#soal{{$index+1}}" aria-controls="soal{{$index+1}}"></i></button>
                                @endif
                            </div>
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
@endsection

@section('footer')
<footer class="navbar-default">
    <div class="container text-center" style="margin-top: 7px;">
        <h5><strong>Copyright &copy; 2020 BBPLK Bekasi.</strong></h5>
    </div>
</footer>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('/plugins/myseleksi.js')}}"></script>
@endsection