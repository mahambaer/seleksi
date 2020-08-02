@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Soal Seleksi</div>

                <div class="panel-body text-center">
                    <div class="btn-group" role="group" aria-label="soal">
                        <a href="{{url('soal/elektronika')}}" class="btn btn-primary">Elektronika</a>
                        <a href="{{url('soal/refrigration')}}" class="btn btn-primary">Refrigration</a>
                        <a href="{{url('soal/tik')}}" class="btn btn-primary">TIK</a>
                        <a href="{{url('soal/pariwisata')}}" class="btn btn-primary">Pariwisata</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
