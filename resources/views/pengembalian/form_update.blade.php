
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
                    <a href="{{ route('pengembalian') }}" class="btn btn-success btn-sm pull-right"><i class="fas fa-box"></i> List Pengembalian </a>
                </p>
                <div class="card-header">
                    <h3 class="card-title">Form Pengembalian</h3>
                </div>
                <form method="POST" action="{{ route('update_pengembalian',['id' => $data->nomor]) }}" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group" >
                                    <label for="exampleInputEmail1">No. Pengembalian</label>
                                    <input type="text"  readOnly class="date  form-control" id="txtnomor" name="txtnomor"  autocomplete="off" value="{{ $data->nomor }}">
                                </div>
                                <div class="form-group" >
                                    <label for="exampleInputEmail1">No. Pinjam</label>
                                    <input type="text" readOnly class="date  form-control" id="slpinjam" name="slpinjam"  autocomplete="off" value="{{ $data->nomor_pinjam }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group" >
                                    <label for="exampleInputEmail1">Tanggal</label>
                                    <input type="text" class="date  form-control" id="txttgl" name="txttgl"  autocomplete="off" value="{{ date('d-m-Y',strtotime($data->tanggal)) }}">
                                </div>
                                <div class="form-group">
                                        <label for="exampleInputEmail1">Ketarangan</label>
                                        <textarea class="form-control" id="txtket" name="txtket" placeholder="Keterangan   " autocomplete="off">{{ $data->keterangan }}</textarea>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table table-bordered" id="products_table">
                                <thead>
                                    <th>Barang</th>
                                    <th>Qty</th>
                                </thead>
                                <tbody>
                                    @foreach ($detail as $key => $details)  
                                      <tr>
                                          <td >
                                              <input type='hidden' class='form-control'  name='barang[{{ $key }}]' value="{{ $details->id_barang }}"> {{ $details->deskripsi }}
                                          </td>
                                          <td>
                                              <input type='hidden' class='form-control'  name='qty[{{ $key }}]' value="{{ $details->jml }}">{{ $details->jml }}
                                          </td>
                                          <td>
                                              <button type='button' class='btn btn-sm btn-danger' style='font-size: 10pt;' id='btn-remove-row'><i class='fas fa-trash'></i></button>
                                          </td>
                                      </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> &nbsp;Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        @include('timeout');
    @endif
@endsection
