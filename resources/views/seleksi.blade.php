@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if($peserta)
                @if ($peserta->status == 'sent' && $peserta->program->status == 'open')
                <div class="panel-heading">Data Peserta Seleksi</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="alert alert-success text-center">
                        <b>Pastikan Data Anda Sesuai!</b>
                    </div>
                    <dl class="alert alert-warning">
                        <dt>Nama</dt><dd>{{$peserta->name}}</dd>
                        <dt>E-mail</dt><dd>{{$peserta->email}}</dd>
                        <dt>Pelatihan yang Dipilih</dt><dd>{{$peserta->program->name}}</dd>
                    </dl>
                    <div class="alert alert-danger">
                        <h3 class="text-center" style="margin: 0"><b>Bacalah Instruksi Berikut Sebelum Memulai</b></h3>
                        <hr>
                        <ol>
                            <li>Bukalah halaman ini menggunakan <b>Browser Google Chrome</b></li>
                            <li>Seleksi online akan dimulai setelah <b>tombol "MULAI SELEKSI ONLINE" ditekan</b>.</li>
                            <li>Waktu mulai berjalan ketika <b>halaman soal dimuat</b>.</li>
                            <li>Seleksi online dianggap selesai setelah Anda <b>menekan tombol "KIRIM" pada halaman soal</b>.</li>
                            <li>Tombol "KIRIM" pada halaman soal hanya dapat ditekan <b>setelah semua soal terisi</b>.</li>
                            <li>Bila waktu habis sebelum Anda mengisi semua soal, <b>sistem akan otomatis menghentikan seleksi online dan tombol "KIRIM" dapat ditekan</b>.</li>
                            <li>Dilarang <b>membuka halaman selain halaman soal</b> atau <b>memuat ulang (reload) halaman soal</b>.</li>
                            <li>Bila memuat ulang halaman soal, seleksi online <b>otomatis dianggap selesai dan score seleksi Anda adalah 0 (nol)</b>.</li>
                            <li><b>Anda tidak dapat memulai kembali seleksi online yang sudah selesai</b>.</li>
                        </ol>
                    </div>
                    <div class="text-center">
                        <a href="{{url('mulai/'.urlencode($peserta->email))}}" class="btn btn-primary">MULAI SELEKSI ONLINE</a>
                    </div>
                </div>
                @elseif($peserta->status == 'pending' || $peserta->program->status == 'close')
                <div class="panel-body" style="padding-bottom: 0">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="alert alert-danger text-center">
                        <p>
                            <b>Anda belum dapat memulai seleksi online.</b>
                        </p>
                    </div>
                </div>
                @else
                <div class="panel-body" style="padding-bottom: 0">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="alert alert-success text-center">
                        <p>
                            <b>Terima kasih telah mengikuti seleksi online kami.</b>
                        </p>
                        <p>
                            Tunggu informasi lebih lanjut.
                        </p>
                    </div>
                </div>
                @endif
                @else
                <div class="panel-body" style="padding-bottom: 0">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="alert alert-danger text-center">
                        <p>
                            <b>Anda tidak terdaftar!</b>
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
@if ($peserta)
<footer class="navbar-default {{$peserta->status == 'start' || $peserta->status == 'end' || $peserta->status == 'pending' || $peserta->program->status == 'close' ? 'navbar-fixed-bottom' : ''}}">
    <div class="container text-center" style="margin-top: 7px;">
        <h5><strong>Copyright &copy; 2020 BBPLK Bekasi.</strong></h5>
    </div>
</footer>
@else
<footer class="navbar-default navbar-fixed-bottom">
    <div class="container text-center" style="margin-top: 7px;">
        <h5><strong>Copyright &copy; 2020 BBPLK Bekasi.</strong></h5>
    </div>
</footer>
@endif
@endsection