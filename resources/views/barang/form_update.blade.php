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
                    <h3 class="card-title">Form Kategori</h3>
                </div>
                <form method="POST" action="{{ route('update_barang',['id' => $data->id_barang ]) }}" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">ID Barang</label>
                            <input type="text" class="form-control" id="txtid" name="txtid" value="{{ $data->id_barang }}" placeholder="ID Barang" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <input type="text" class="form-control" id="txtdesc" name="txtdesc" value="{{ $data->deskripsi }}" placeholder="Description" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori</label>
                            <select class="form-control"  id="txtkategori" name="txtkategori">
                                <option hidden>Pilih Category</option>
                                @foreach ($kategori as $item)
                                    @if($item->kategori_id == $data->kategori_id)
                                        <option value="{{ $item->kategori_id }}" selected >{{ $item->kategori }}</option>
                                    @else
                                        <option value="{{ $item->kategori_id }}" >{{ $item->kategori }}</option>
                                    @endif    
                                @endforeach
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputEmail1">Kondisi</label>
                            <select class="form-control" id="txtkondisi" name="txtkondisi">
                                <option hidden>Pilih Kondisi</option>
                                @foreach ($kondisi as $item)
                                    
                                    @if($item->kondisi_id == $data->kondisi_id)
                                        <option value="{{ $item->kondisi_id }}" selected >{{ $item->kondisi }}</option>
                                    @else
                                        <option value="{{ $item->kondisi_id }}">{{ $item->kondisi }}</option>
                                    @endif 
                                @endforeach
                            </select>
                        </div> -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jumlah</label>
                            <input type="text" class="form-control" id="txtjml" name="txtjml" value="{{ $data->jml }}" placeholder="Jumlah" autocomplete="off">
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