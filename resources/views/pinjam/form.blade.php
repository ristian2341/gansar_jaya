
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
                    <a href="{{ route('pinjam') }}" class="btn btn-success btn-sm pull-right"><i class="fas fa-box"></i> List User </a>
                </p>
                <div class="card-header">
                    <h3 class="card-title">Form Pinjam</h3>
                </div>
                <form method="POST" action="{{ route('simpan_pinjam') }}" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group" >
                                    <label for="exampleInputEmail1">Tanggal</label>
                                    <input type="text" class="date  form-control" id="txttgl" name="txttgl"  autocomplete="off" value="{{ date('d-m-Y') }}">
                                </div>
                                <div class="form-group" >
                                    <label for="exampleInputEmail1">Estimasi Kembali</label>
                                    <input type="text"  class="date form-control" id="txttglest" name="txttglest" value="<?= date('d-m-Y',strtotime(date('Y-m-d'). '+10 days')); ?>"  autocomplete="off">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <input type="text" class="form-control" id="txtdesc" name="txtdesc" placeholder="Description" autocomplete="off">
                                </div> -->
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
                                    <tr>
                                        <td style="width: 70%;">
                                            <select class="form-control select2 select2-danger"     data-dropdown-css-class="select2-danger" style="width: 100%;"  id="txtbarang" name="txtbarang">
                                                <option value="" hidden>Pilih Barang</option>
                                                @foreach ($barang as $item)
                                                <option value="{{ $item->id_barang }}" data-stok="{{ $item->jml - $item->stok_out }}">{{ $item->deskripsi }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="width: 20%;">
                                             <input type="text" class="form-control" id="txtjml" name="txtjml" placeholder="Jumlah" autocomplete="off">
                                        </td>
                                        <td>
                                             <button type="button" class="btn btn-sm btn-info" style="font-size: 10pt;" id="btn-add-row"><i class="fas fa-plus"></i> Add</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Qty</th>
                                        <th>&nbsp;</th>
                                    </tr>
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
            $("body").off("click","#btn-add-row").on("click","#btn-add-row",function(e){
                var barang = $("#txtbarang").val();var line = $('#detail tr').length ;
                var nama_barang = $("#txtbarang :selected").text();
                var qty = $("#txtjml").val();
                var stok = $("#txtbarang").find(':selected').attr('data-stok');
                if(barang != '' && qty != ''){
                    sisa = stok - qty;
                    if(sisa >= 0){
                        var i = 0;
                        while(i < line){
                            if($("input[name=\"barang["+i+"]\"]").val() == barang){
                                alert('Barang sudah ada, hapus data dulu baru update Quantity');
                                return false;
                            }
                            i++;
                        }

                        var tr = "<tr><td ><input type='hidden' class='form-control'  name='barang["+ line +"]' value="+barang+">"+ nama_barang +"</td><td><input type='hidden' class='form-control'  name='qty["+ line +"]' value="+qty+">"+ qty +"</td><td><button type='button' class='btn btn-sm btn-danger' style='font-size: 10pt;' id='btn-remove-row'><i class='fas fa-trash'></i></button></td></tr>";
                        $("#detail").append(tr);
                        $("#txtbarang").val('').trigger('change');
                        $("#txtjml").val('');
                    }else{
                        alert("Qty tidak mencukupi, sisa stok : "+ stok);
                    }
                }else if(barang == ''){
                    alert("Barang tidak boleh kosong");
                }else if(qty == ''){
                    alert("Qty tidak boleh kosong");
                }
            });

            $('body').off('click','#btn-remove-row').on('click','#btn-remove-row',function(){
                $(this).closest("tr").remove();
            })
        </script>
    @else
        @include('timeout');
    @endif
@endsection
