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
            <a href="{{ route('form_user') }}" class="btn btn-success pull-right"><i class="fas fa-users"></i> Add User </a>
        </p>
        <div class="card-body table-responsive p-0" style="height: 600px;">
            <table class="table table-head-fixed table-hover table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10%;">No.</th>
                        <th>Nama User</th>
                        <th style="width: 20%;text-align: center;">Jabatan</th>
                        <th style="width: 20%;text-align: center;">No. WA</th>
                        <th style="width: 10%;text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($data_user))
                        <?php foreach ($data_user->data as $key => $value) { ?>
                            <tr>
                                <td><?=  $key + 1; ?></td>
                                <td><?= $value->nama; ?></td>
                                <td><?= $value->jabatan; ?></td>
                                <td><?= $value->wa; ?></td>
                                <td>
                                    @if($value->id_user != 1)
                                        <a href="{{ route('user_update',['id' => $value->id_user])}}" class="btn btn-sm btn-warning" tittle="Update User"><i class="fas fa-pencil-ruler"></i></a>
                                        <a href="{{ route('delete',['id' => $value->id_user])}}" onclick="return confirm('Apakah Anda Yakin Menghapus Data ?');"  class="btn btn-sm btn-danger" tittle="Hapus Data"><i class="fas fa-trash"></i></a>
                                    @endif
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