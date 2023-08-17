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
        <!-- /.login-logo -->
        <div class="card">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Kategori</h3>
                </div>
                <form method="POST" action="{{ route('update_kategori',['id' => $data->kategori_id ]) }}" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">ID</label>
                            <input type="text" readonly class="form-control" id="txtid" name="txtid" value="{{ $data->kategori_id  }}" placeholder="kategori_id" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori</label>
                            <input type="text" class="form-control" id="txtkategori" name="txtkategori"  value="{{ $data->kategori }}" placeholder="Kategori Barang" autocomplete="off">
                        </div>
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.login-box -->
    @else
        @include('timeout');
    @endif
@endsection