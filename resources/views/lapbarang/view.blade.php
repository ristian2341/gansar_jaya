@extends('layout')
@section('content')

    @if(Session::get('s_username') != '')
        <p class="text-left">
            <a href="{{ route('lap_barang') }}" class="btn btn-success btn-sm pull-right"><i class="fas fa-box"></i> List User </a>
        </p>
        <div class="card-header">
            <h3 class="card-title">View Data Laporan : {{ $data->nomor }}</h3>
        </div>
        <table class="table" style="font-size: 11pt;">
            <thead>
                <tr>
                    <td>Tanggal</td>
                    <td>{{ date('d M Y',strtotime($data->tanggal)) }}</td>
                </tr>
                <tr>
                    <td>Barang</td>
                    <td>{{ $data->deskripsi }}</td>
                </tr>
                <tr>
                    <td>Kondisi</td>
                    <td>{{ $data->kondisi }}</td>
                </tr>
                <tr>
                    <td>Jum. Lap</td>
                    <td>{{ $data->jml }}</td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>{{ $data->keterangan }}</td>
                </tr>
                <?php
                    if($data->status == 1){
                        $status = "Active";
                    }elseif($data->status == 2){
                        $status = "Approved";
                    }elseif($data->status == 0){
                        $status = "Deleted";
                    }
                ?>
                <tr>
                    <td>Status</td>
                    <td>{{ $status }}</td>
                </tr>
            </thead>
        </table>
    @else
        @include('timeout');
    @endif

@endsection