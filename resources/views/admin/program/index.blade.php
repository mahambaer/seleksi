@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Program Pelatihan</div>

                <div class="panel-body text-center">
                    <div class="no-padding">
                        <table id="program" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Judul Pelatihan</th>
                                    <th>Nama Kejuruan</th>
                                    <th>Waktu Pengerjaan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($programs as $program)
                                    <tr>
                                        <td>{{$program->name}}</td>
                                        <td>{{$program->kejuruan->name}}</td>
                                        <td>{{$program->durasi}}</td>
                                        <td>{{$program->status}}</td>
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
    $('#program').DataTable({
        'paging'          : true,
        'lengthChange'    : true,
        'searching'       : true,
        'ordering'        : true,
        'info'            : true,
        'autoWidth'       : false,
        'scrollX'         : true,
        'pageLength'      : 50
    });
</script>
@endsection
