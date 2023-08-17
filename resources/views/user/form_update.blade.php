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
                    <h3 class="card-title">Form User</h3>
                </div>
                <form method="POST" action="{{ route('update_user',['id' => $data->id_user ]) }}" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">User ID</label>
                            <input type="text" readonly class="form-control" id="txtid" name="txtid" value="{{ $data->id_user  }}" placeholder="Nama User" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="text" class="form-control" id="txtname" name="txtname"  value="{{ $data->nama  }}" placeholder="Nama User" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jabatan</label>
                            <input type="text" class="form-control" id="txtjabatan" name="txtjabatan" placeholder="Jabatan" autocomplete="off" value="{{ $data->jabatan }}" onkeyup="javascript: this.value = this.value.toUpperCase();">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Whatapp</label>
                            <input type="text" class="form-control" id="txtwa" name="txtwa" value="{{ $data->wa  }}"  placeholder="Nomor WA" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">User Name</label>
                            <input type="text" class="form-control" id="txtusername" name="txtusername"  value="{{ $data->user_name  }}"  autocomplete="off" placeholder="User Name Log in">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="txtpass" name="txtpass"  autocomplete="off" placeholder="Password">
                        </div>
                        <div class="form-check">        
                            <label class="form-check-label" for="exampleCheck1"><input type="checkbox" class="form-check-input" id="txtadmin" name="txtadmin" <?= ($data->administrator == 1 ) ? "checked"  :""; ?> value="1"> Administrator</label>
                        </div>
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>
        </div>
        <!-- /.login-box -->
    @else
        @include('timeout');
    @endif
@endsection