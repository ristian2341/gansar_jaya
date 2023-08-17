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
                <p class="text-left">
                    <a href="{{ route('barang') }}" class="btn btn-success pull-right"><i class="fas fa-box"></i> List Barang </a>
                </p>
                <div class="card-header">
                    <h3 class="card-title">Form Barang</h3>
                </div>
                <form method="POST" action="{{ route('simpan_barang') }}" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <input type="text" class="form-control" id="txtdesc" name="txtdesc" placeholder="Description" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori</label>
                            <select class="form-control" id="txtkategori" name="txtkategori">
                                <option hidden>Pilih Category</option>
                                @foreach ($kategori as $item)
                                <option value="{{ $item->kategori_id }}">{{ $item->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputEmail1">Kondisi</label>
                            <select class="form-control" id="txtkondisi" name="txtkondisi">
                                <option hidden>Pilih Kondisi</option>
                                @foreach ($kondisi as $item)
                                <option value="{{ $item->kondisi_id }}">{{ $item->kondisi }}</option>
                                @endforeach
                            </select>
                        </div> -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jumlah</label>
                            <input type="text" class="form-control" id="txtjml" name="txtjml" placeholder="Jumlah" autocomplete="off">
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