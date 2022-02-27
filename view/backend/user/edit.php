<?php
$user = user_get_one(['ma_kh'=>$_GET['id']])
?>
<div class="card-header">
    <h3 class="card-title">
    <i class="fas fa-edit"></i>
        Sửa Thông Tin Khách Hàng
    </h3>
</div>
<!-- /.card-header -->
<h4 class="text-center card-header text-success"><?php echo @$msg; ?></h4>
<form action="" method="post" enctype="multipart/form-data">
  <!-- content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">General</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
          <div class="form-group">
              <label for="inputName">Mã KH</label>
              <input type="text" readonly name="ma_kh" class="form-control" value="<?= $user['ma_kh'] ?>">
            </div>
            <div class="form-group">
              <label for="inputName">Họ Tên</label>
              <input type="text" name="ho_ten" class="form-control" value="<?= $user['ho_ten'] ?>">
              <?= (isset($err['ho_ten']) ? $err['ho_ten'] : '') ?> 
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Mật Khẩu</label>
              <input type="password" name="mat_khau" class="form-control" value="<?= $user['mat_khau'] ?>">
              <?= (isset($err['mat_khau']) ? $err['mat_khau'] : '') ?> 
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Xác Nhận Mật Khẩu</label>
              <input type="password" name="mat_khau2" class="form-control" value="<?= $user['mat_khau'] ?>">
              <?= (isset($err['mat_khau2']) ? $err['mat_khau2'] : '') ?> 
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Avatar</label>
              <input name="hinh" type="hidden" value="<?= $user['hinh'] ?>">
              <input type="file" name="up_hinh" class="form-control">(<?= $user['hinh'] ?>)
              <?= (isset($err['hinh']) ? $err['hinh'] : '') ?> 
            </div>
            <div class="form-group">
              <label for="inputEstimatedBudget">Email</label>
              <input type="text" name="email" class="form-control" value="<?= $user['email'] ?>">
              <?= (isset($err['email']) ? $err['email'] : '') ?> 
            </div>
            <div class="form-group">
              <label for="inputSpentBudget">Số Điện Thoại</label>
              <input type="text" name="so_dt" class="form-control" value="<?= $user['so_dt'] ?>">
              <?= (isset($err['so_dt']) ? $err['so_dt'] : '') ?> 
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Budget</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Vai Trò</label> <br>
              <label>
                <input <?= !$user['vai_tro'] ? 'checked' : '' ?> name="vai_tro" value="0" type="radio">
                Khách Hàng
              </label>
              <label>
                <input <?= $user['vai_tro'] ? 'checked' : '' ?> name="vai_tro" value="1" type="radio">
                Nhân Viên
              </label>
            </div>
            <div class="form-group">
              <label>Kích Hoạt</label> <br>
              <label>
                <input <?= !$user['kich_hoat'] ? 'checked' : '' ?> name="kich_hoat" value="0" type="radio">
                Chưa kích hoạt
              </label>
              <label>
                <input <?= $user['kich_hoat'] ? 'checked' : '' ?> name="kich_hoat" value="1" type="radio">
                Kích hoạt
              </label>
            </div>
            <!-- <div class="form-group">
            <label for="inputEstimatedDuration">Kích Hoạt</label> <br>
            <input type="checkbox" name="kich_hoat" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"  value="1">
            </div> -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
      <input type="submit" name="btnSave" value="Save" class="btn btn-success ml-2 float-right">
        <button class="btn btn-secondary float-right ml-2 " type="reset">Reset</button>
        <a href="?module=backend&controller=user&action=list" type="input" class="btn btn-primary float-right"><i class="fas fa-list-ul"> List</i></a>
      </div>
    </div>
  </section>
  <!-- /.content -->
</form>