@extends('layout')
@section('content')
    @if(\Session::has('alert'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" >x</button>
            <strong>Status : </strong>{{Session::get('alert')}}
        </div>
    @elseif($errors->any())
        <div class="error alert-danger">
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
        <p class="text-left">
            <a href="{{ route('form_barang') }}" class="btn btn-success pull-right"><i class="fas fa-plus-circle"></i> Add Barang </a>
            <a href="{{ route('excel_barang') }}" class="btn btn-success pull-right"><i class="fas fa-download"></i> Export Excel </a>
        </p>
        <div class="card-body " style="height: 100%;">
            <table id="datagrid" class="table table-striped table-bordered" style="font-size: 10pt;">
                <thead>
                    <th style="width: 10%;">No.</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <!-- <th>Kondisi</th> -->
                    <th>Jml</th>
                    <th>Keluar</th>
                    <th>Stok</th>
                    <th style="width: 10%;text-align: center;">Action</th>
                </thead>
                <tbody>
                    @if(count($data) > 0)
                        <?php foreach ($data as $key => $value) { ?>
                            <tr>
                                <td><?=  $key + 1; ?></td>
                                <td><?= $value->deskripsi; ?></td>
                                <td><?= $value->kategori; ?></td>
                                <!-- <td><?= $value->kondisi_id; ?></td> -->
                                <td><?= $value->jml; ?></td>
                                <td><?= $value->stok_out; ?></td>
                                <td><?=  $value->jml - $value->stok_out; ?></td>
                                <td>
                                        <a href="{{ route('barang_update',['id' => $value->id_barang])}}" class="btn btn-sm btn-warning" tittle="Update Barang"><i class="fas fa-pencil-ruler"></i></a>
                                        <a href="{{ route('delete_barang',['id' => $value->id_barang])}}" onclick="return confirm('Apakah Anda Yakin Menghapus Data ?');"  class="btn btn-sm btn-danger" tittle="Hapus Data"><i class="fas fa-trash"></i></a>
                                   
                                </td>
                            </tr>
                        <?php } ?>
                    @else
                        <tr>
                            <td colspan="4">Data Kosong</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    @else
        @include('timeout');
    @endif
@endsection