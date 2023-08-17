@extends('layout')
@section('content')
@if(\Session::has('alert'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" >x</button>
            <strong>Status : </strong>{{Session::get('alert')}}
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
        <!-- /.login-logo -->
        <div class="card">
            <div class="card card-primary">
                <p class="text-left">
                    <a href="{{ route('lap_barang') }}" class="btn btn-success btn-sm pull-right"><i class="fas fa-box"></i> List User </a>
                </p>
                <div class="card-header">
                    <h3 class="card-title">Form Barang</h3>
                </div>
                <form method="POST" action="{{ route('simpan_laporan') }}" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <input type="text" class="form-control" id="txttgl" name="txttgl" placeholder="Tanggal..." value="{{ date('d-m-Y') }}" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Barang</label>
                                        <select class="form-control select2 select2-danger"     data-dropdown-css-class="select2-danger" style="width: 100%;"  id="txtbarang" name="txtbarang">
                                            <option value="" hidden>Pilih Barang</option>
                                            @foreach ($barang as $item)
                                            <option value="{{ $item->id_barang }}" data-stok="{{ $item->jml - $item->stok_out }}">{{ $item->deskripsi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kondisi Laporan</label>
                                            <select class="form-control" style="width: 100%;"  id="slkondisi" name="slkondisi">
                                                <option value="RUSAK">Rusak</option>
                                                <option value="HILANG">Hilang</option>      
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Jumlah</label>
                                            <input type="text" class="form-control" id="txtjml" name="txtjml" placeholder="Jumlah.."  autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Keterangan</label>
                                            <textarea class="form-control" id="txtket" name="txtket" placeholder="Keterangan   " autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>    
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