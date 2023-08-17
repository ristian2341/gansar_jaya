@extends('layout')
@section('content')

    @if(Session::get('s_username') != '')
        <p class="text-left">
            <a href="{{ route('pinjam') }}" class="btn btn-success btn-sm pull-right"><i class="fas fa-box"></i> List User </a>
        </p>
        <div class="card-header">
            <h3 class="card-title">View Data Pinjam : {{ $pinjam->nomor_pinjam  }}</h3>
        </div>
        <table class="table" style="font-size: 11pt;">
            <thead>
                <tr>
                    <td>Tanggal</td>
                    <td>{{ date('d M Y',strtotime($pinjam->tanggal)) }}</td>
                </tr>
                <tr>
                    <td>Tanggal Estimasi</td>
                    <td>{{ date('d M Y',strtotime($pinjam->tgl_kembali)) }}</td>
                </tr>
                <tr>
                    <td>Dibuat Oleh</td>
                    <td>{{ $pinjam->nama }}</td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>{{ $pinjam->keterangan }}</td>
                </tr>
                <?php
                    if($pinjam->status == 1){
                        $status = "Active";
                    }elseif($pinjam->status == 2){
                        $status = "Approved";
                    }elseif($pinjam->status == 0){
                        $status = "Deleted";
                    }
                ?>
                <tr>
                    <td>Status</td>
                    <td>{{ $status }}</td>
                </tr>
            </thead>
        </table>
        <table class="table table-bordered table-striped" style="font-size: 11pt;">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody id="detail">
                @foreach ($detail as $key => $details)
                    <tr>
                        <td >
                            {{ $details->deskripsi }}
                        </td>
                        <td>
                           {{ $details->jml }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        @include('timeout');
    @endif

@endsection