<?php
require_once APP_PATH . '/model/user_model.php';
$ma_kh = get_cookie("ma_kh");
$mat_khau = get_cookie("mat_khau");
?>

<body>
  <div class="container mt-3 ml-2">
    <div class="col-10 bg-light px-4  pb-3">
      <div class="row  border-bottom mb-3 p-4 d-flex justify-content-between">
        <div class="">
          <p class="text-uppercase font-weight-bold">đăng nhập</p>
        </div>
        <div class="">
          <span>Bạn chưa có tài khoản? </span>
          <a class="text-primary" href="<?= BASE_URL ?>/?controller=user&action=register">Đăng ký</a>
          <span> tại đây</span>
        </div>
      </div>
      <form action="" class="form-group" method="post">
        <label class="mb-2">Mã đăng nhập</label>
        <div class="input-group mb-3">
          <input class="form-control" placeholder="Mã KH" name="ma_kh" value="<?= $ma_kh ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <label class="mb-2">Mật khẩu</label>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="mat_khau" value="<?= $mat_khau ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="ghi_nho" checked>
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="btn_login">Đăng nhập</button>
          </div>
        </div>
      </form>
      <div>
        <p class="mb-1">
          <a href="?controller=user&action=forgot">Quên mật khẩu</a>
        </p>
        <p class="">
          <a href="?controller=user&action=register" class="text-center">Đăng ký thành viên mới</a>
        </p>
      </div>
    </div>
  </div>
  <!-- /.login-box -->
</body>