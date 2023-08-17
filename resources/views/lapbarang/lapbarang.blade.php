@extends('layout')
@section('content')
    @if(\Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" >x</button>
            <strong>Status : </strong>{{Session::get('alert')}}
        </div>
    @elseif(\Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" >x</button>
            <strong>Status : </strong> {{Session::get('error')}}
        </div>
    @elseif(Session::get('alert') !='')
            <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" >x</button>
                <strong>Status : </strong>{{Session::get('alert')}}
            </div>
    @endif

    @if(Session::get('s_username') != '')
        <p class="text-left">
            <a href="{{ route('form_lap_barang') }}" class="btn btn-success pull-right"><i class="fas fa-plus-circle"></i> Add Laporan </a>
        </p>
        <div class="card-body table-responsive p-0" style="height: 600px;">
            <table class="table table-head-fixed table-hover table-bordered table-striped" style="font-size: 10pt;">
                <thead>
                    <th style="width: 3%;">No.</th>
                    <th style="width: 13%;">No. Doc</th>
                    <th style="width: 9%;">Tanggal</th>
                    <th style="width: 20%;">Barang</th>
                    <th style="width: 7%;">Kondisi</th>
                    <th style="width: 5%;">Jml</th>
                    <th>Keterangan</th>
                    <th style="width: 5%;">status</th>
                    <th style="width: 10%;text-align: center;">Action</th>
                </thead>
                <tbody>
                    @if(count($data) > 0)
                        <?php foreach ($data as $key => $value) { ?>
                            <tr>
                                <td><?=  $key + 1; ?></td>
                                <td><?= $value->nomor; ?></td>
                                <td><?= date('d-m-Y',strtotime($value->tanggal)); ?></td>
                                <td><?= $value->barang; ?></td>
                                <td><?= $value->kondisi; ?></td>
                                <td><?= $value->jml; ?></td>
                                <td><?= $value->keterangan; ?></td>
                                <?php
                                    if($value->status == 1){
                                        $status = "Active";
                                    }elseif($value->status == 2){
                                        $status = "Approved";
                                    }elseif($value->status == 0){
                                        $status = "Deleted";
                                    }
                                ?>
                                <td><?= $status; ?></td>
                                <td>
                                    <a href="{{ route('view_lapbarang',['id' => $value->nomor])}}" class="btn btn-sm btn-info" tittle="View"><i class="fas fa-search"></i></a>
                                    @if(Session::get('s_superUser') == 1 && $value->status == 1)
                                        <a href="{{ route('approve_lapbarang',['id' => $value->nomor])}}" class="btn btn-sm  btn-primary" tittle="Approve Laporan"><i class="fas fa-check"></i></a>
                                    @elseif($value->status == 1)
                                        <a href="{{ route('lapbarang_update',['id' => $value->nomor])}}" class="btn btn-sm btn-warning" tittle="Update Lap Barang"><i class="fas fa-pencil-ruler"></i></a>
                                        <a href="{{ route('lapbarang_delete',['id' => $value->nomor])}}" onclick="return confirm('Apakah Anda Yakin Menghapus Data ?');"  class="btn btn-sm btn-danger" tittle="Hapus Data"><i class="fas fa-trash"></i></a>
                                    @endif
                                   
                                </td>
                            </tr>
                        <?php } ?>
                    @else
                        <tr>
                            <td colspan="8">Data Kosong</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    @else
        @include('timeout');
    @endif
@endsection