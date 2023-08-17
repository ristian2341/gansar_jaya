<div class="login-box">
    <div class="login-logo">
        <img src="admin/dist/img/fav-icon-front.png" alt="Gansar Jaya" class="brand-image img-circle elevation-2" style="opacity: .6;width: 25%">
        <span class="brand-text font-weight-light"><strong>PT Gansar Jaya</strong></span>
    </div>
    @if(\Session::has('alert'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Status : </strong>{{Session::get('alert')}}
        </div>
    @endif
    @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Status : Kode Captcha tidak sama</strong>
                    @endforeach
            </div>
    @endif
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Log in Aplikasi Gansar Jaya</p>
      <form method="POST" action="{{ route('postlogin') }}">
      @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="User Name" name="user_name" id="user_name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
