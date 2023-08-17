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
            <a href="{{ route('form_kategori') }}" class="btn btn-success pull-right"><i class="fas fa-plus-circle"></i> Add Kategori </a>
        </p>
        <div class="card-body table-responsive p-0" style="height: 600px;">
            <table class="table table-head-fixed table-hover table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10%;">No.</th>
                        <th>Kategori</th>
                        <th style="width: 10%;text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($data) > 0)
                        <?php foreach ($data as $key => $value) { ?>
                            <tr>
                                <td><?=  $key + 1; ?></td>
                                <td><?= $value->kategori; ?></td>
                                <td>
                                        <a href="{{ route('kategori_update',['id' => $value->kategori_id])}}" class="btn btn-sm btn-warning" tittle="Update kategoris"><i class="fas fa-pencil-ruler"></i></a>
                                        <a href="{{ route('delete_kategori',['id' => $value->kategori_id])}}" onclick="return confirm('Apakah Anda Yakin Menghapus Data ?');"  class="btn btn-sm btn-danger" tittle="Hapus Data"><i class="fas fa-trash"></i></a>
                                   
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