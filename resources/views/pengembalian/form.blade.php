
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
                <form method="POST" action="{{ route('simpan_pengembalian') }}" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group" >
                                    <label for="exampleInputEmail1">Tanggal</label>
                                    <input type="text" class="date  form-control" id="txttgl" name="txttgl"  autocomplete="off" value="{{ date('d-m-Y') }}">
                                </div>
                                <div class="form-group" >
                                    <label for="exampleInputEmail1">No. Pinjam</label>
                                    <select class="form-control select2 select2-danger"     data-dropdown-css-class="select2-danger" style="width: 100%;"  id="slpinjam" name="slpinjam">
                                        <option value="" hidden>Nomor Pinjam</option>
                                        @if(isset($pinjams))
                                            @foreach ($pinjams as $pinjam)
                                                <option value="{{ $pinjam->nomor_pinjam }}">{{ $pinjam->nomor_pinjam }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                        <label for="exampleInputEmail1">Ketarangan</label>
                                        <textarea class="form-control" id="txtket" name="txtket" placeholder="Keterangan   " autocomplete="off"></textarea>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table table-bordered" id="products_table">
                                <thead>
                                    <th>Barang</th>
                                    <th>Qty</th>
                                </thead>
                                <tbody id="detail"></tbody>
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

        <script>
            $(document).ready(function(){
                $('#slpinjam').change(function(){
                    if(this.value != ''){
                        $.ajax({
                            type : 'POST',
                            url : '{{ route("detailpinjam") }}',
                            data :{
                                "_token": "{{ csrf_token() }}",
                                nomor_pinjam : this.value,
                            },
                            success:function(data)
                            {
                               $('#detail').html(data.tr);                              
                            }
                        });
                    }
                });
            });
        </script>
    @else
        @include('timeout');
    @endif
@endsection
