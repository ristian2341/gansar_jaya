@extends('layout')
@section('content')
    @if(\Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" >x</button>
            <strong>Status : </strong>{{Session::get('success')}}
        </div>
    @elseif(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" >x</button>
            <strong>Status : </strong> {{Session::get('error')}}
        </div>
    @elseif(Session::get('alert') !='')
            <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" >x</button>
                <strong>Status : </strong>{{Session::get('alert')}}
            </div>
    @endif

    @if(Session::get('s_username') != '')
        @if(Session::get('s_superUser') != 1)
            <p class="text-left">
                <a href="{{ route('form_pinjam') }}" class="btn btn-success pull-right"><i class="fas fa-plus-circle"></i> Add Pinjam </a>
            </p>
        @endif
        <div class="card-body table-responsive p-0" style="height: 600px;">
            <table class="table table-head-fixed table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10%;">No.</th>
                        <th>Nomor Pinjam</th>
                        <th>Tanggal</th>
                        <th>Oleh</th>
                        <th>Tgl Estimasi</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th style="width: 10%;text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($data) > 0)
                        <?php foreach ($data as $key => $value) { ?>
                            <tr>
                                <td><?=  $key + 1; ?></td>
                                <td><?= $value->nomor_pinjam; ?></td>
                                <td><?= date('d-m-Y',strtotime($value->tanggal)); ?></td>
                                <td><?= $value->nama; ?></td>
                                <td><?= date('d-m-Y',strtotime($value->tgl_kembali)); ?></td>
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
                                    <a href="{{ route('view_pinjam',['id' => $value->nomor_pinjam])}}" class="btn btn-sm btn-info" tittle="Update Pinjam"><i class="fas fa-search"></i></a>
                                    @if(Session::get('s_superUser') == 1 && $value->status == 1)
                                        <a href="{{ route('approve_pinjam',['id' => $value->nomor_pinjam])}}" class="btn btn-sm  btn-primary" tittle="Approve Pinjam"><i class="fas fa-check"></i></a>
                                    @elseif($value->status == 1)
                                        <a href="{{ route('pinjam_update',['id' => $value->nomor_pinjam])}}" class="btn btn-sm btn-warning" tittle="Update Pinjam"><i class="fas fa-pencil-ruler"></i></a>
                                        <a href="{{ route('delete_pinjam',['id' => $value->nomor_pinjam])}}" onclick="return confirm('Apakah Anda Yakin Menghapus Data ?');"  class="btn btn-sm btn-danger" tittle="Hapus Data"><i class="fas fa-trash"></i></a>
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