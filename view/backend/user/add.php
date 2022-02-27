<div class="card-header">
    <h3 class="card-title">
    <i class="fas fa-user-plus"></i>
        Thêm Khách Hàng
    </h3>
</div>
<!-- /.card-header -->
<h4 class="text-center  text-success"><?php echo @$msg; ?></h4>
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
              <label for="inputName">Mã Khách Hàng</label>
              <input type="text" name="ma_kh" class="form-control">
              <?= (isset($err['ma_kh']) ? $err['ma_kh'] : '') ?> 
            </div>
            <div class="form-group">
              <label for="inputName">Họ Tên</label>
              <input type="text" name="ho_ten" class="form-control">
              <?= (isset($err['ho_ten']) ? $err['ho_ten'] : '') ?> 
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Mật Khẩu</label>
              <input type="password" name="mat_khau" class="form-control">
              <?= (isset($err['mat_khau']) ? $err['mat_khau'] : '') ?> 
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Xác Nhận Mật Khẩu</label>
              <input type="password" name="mat_khau2" class="form-control">
              <?= (isset($err['mat_khau2']) ? $err['mat_khau2'] : '') ?> 
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Avatar</label>
              <input type="file" name="hinh" class="form-control">
              <?= (isset($err['hinh']) ? $err['hinh'] : '') ?> 
            </div>
            <div class="form-group">
              <label for="inputEstimatedBudget">Email</label>
              <input type="text" name="email" class="form-control">
              <?= (isset($err['email']) ? $err['email'] : '') ?> 
            </div>
            <div class="form-group">
              <label for="inputSpentBudget">Số Điện Thoại</label>
              <input type="text" name="so_dt" class="form-control">
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
              <label>KÍCH HOẠT?</label>
              <div class="form-control">
                <label><input name="kich_hoat" value="0" type="radio">Chưa kích hoạt</label>
                <label><input name="kich_hoat" value="1" type="radio" checked>Kích hoạt</label>
              </div>
            </div>
            <div class="form-group">
              <label>VAI TRÒ</label>
              <div class="form-control">
                <label><input name="vai_tro" value="0" type="radio"checked >Khách hàng</label>
                <label><input name="vai_tro" value="1" type="radio" >Nhân viên</label>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <input type="submit" name="btnSave" value="Create New" class="btn btn-success ml-2 float-right">
        <button class="btn btn-secondary float-right ml-2 " type="reset">Reset</button>
        <a href="?module=backend&controller=user&action=list" type="input" class="btn btn-primary float-right"><i class="fas fa-list-ul"> List</i></a>
      </div>
    </div>
  </section>
  <!-- /.content -->
</form>