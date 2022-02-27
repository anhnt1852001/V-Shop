<div class="card-header">
  <h3 class="card-title">
    <i class="fas fa-plus-circle"></i>
    Thêm Sản Phẩm
  </h3>
</div>
<!-- /.card-header -->
<h4 class="text-center card-header text-success"><?php echo @$msg; ?></h4>
<?php
require_once APP_PATH . '/model/categories_model.php';
require_once APP_PATH . '/model/trademark_model.php';
$cate_select_list = categories_list_all();
$trademark_select_list = trademark_list_all();
?>
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
              <label for="inputName">Mã Hàng Hóa</label>
              <input name="ma_hh" class="form-control" readonly value="auto number">
            </div>
            <div class="form-group">
              <label for="inputName">Tên Hàng Hóa</label>
              <input type="text" name="ten_hh" class="form-control">
              <?= (isset($err['ten_hh']) ? $err['ten_hh'] : '') ?>
            </div>
            <div>
              <label>THƯƠNG HIỆU</label>
              <select class="form-control select2" name="ma_th">
                <?php
                foreach ($trademark_select_list as $trademark) {
                  echo '<option value="' . $trademark['ma_th'] . '">' . $trademark['ten_th'] . '</option>';
                }
                ?>
              </select>
            </div>
            <div>
              <label>MẶT HÀNG</label>
              <select class="form-control select2" name="ma_mh">
                <?php
                foreach ($cate_select_list as $cate) {
                  echo '<option value="' . $cate['ma_mh'] . '">' . $cate['ten_mh'] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Đơn Giá</label>
              <input type="number" name="don_gia" class="form-control">
              <?= (isset($err['don_gia']) ? $err['don_gia'] : '') ?>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Giảm Giá</label>
              <input type="text" name="giam_gia" class="form-control">
              <?= (isset($err['giam_gia']) ? $err['giam_gia'] : '') ?>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Hình</label>
              <input type="file" name="hinh" class="form-control">
              <?= (isset($err['hinh']) ? $err['hinh'] : '') ?>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Banner</label>
              <input type="file" name="banner" class="form-control">
              <?= (isset($err['banner']) ? $err['banner'] : '') ?>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Ram</label>
              <input type="number" name="ram" class="form-control">
              <?= (isset($err['ram']) ? $err['ram'] : '') ?>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Storage</label>
              <input type="number" name="storage" class="form-control">
              <?= (isset($err['storage']) ? $err['storage'] : '') ?>
            </div>
            <div class="form-group">
              <label>Status</label>
              <div class="form-control">
                <label><input name="status" value="0" type="radio" >Giới thiệu</label>
                <label><input name="status" value="1" type="radio" checked>Bán</label>
              </div>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Số Lượng</label>
              <input type="number" name="so_luong" class="form-control">
              <?= (isset($err['so_luong']) ? $err['so_luong'] : '') ?>
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
              <label for="inputClientCompany">Ngày Nhập</label>
              <input type="date" name="ngay_nhap" class="form-control">
              <?= (isset($err['ngay_nhap']) ? $err['ngay_nhap'] : '') ?>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Số Lượt Xem</label>
              <input readonly name="so_luot_xem" value="0" class="form-control">
            </div>
            <div class="form-group">
              <label>Hàng Đặc Biệt</label>
              <div class="form-control">
                <label><input name="dac_biet" value="0" type="radio" checked>Bình Thường</label>
                <label><input name="dac_biet" value="1" type="radio">Đặc Biệt</label>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEstimatedBudget">Mô Tả</label>
              <textarea class="textarea" name="mo_ta" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              <?= (isset($err['mo_ta']) ? $err['mo_ta'] : '') ?>
            </div>
          </div>
        </div>
        <!-- slide -->
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
        <label for="inputClientCompany">Mã SLide</label>
        <input value="Auto" name="ma_slide" class="form-control" readonly>
        <?= (isset($err['hinh']) ? $err['hinh'] : '') ?>
      </div>
      <div class="form-group">
        <label for="inputClientCompany">SLider1</label>
        <input type="file" name="ten_slide1" class="form-control">
        <?= (isset($err['hinh']) ? $err['hinh'] : '') ?>
      </div>
      <div class="form-group">
        <label for="inputClientCompany">SLider2</label>
        <input type="file" name="ten_slide2" class="form-control">
        <?= (isset($err['hinh']) ? $err['hinh'] : '') ?>
      </div>
      <div class="form-group">
        <label for="inputClientCompany">SLider3</label>
        <input type="file" name="ten_slide3" class="form-control">
        <?= (isset($err['hinh']) ? $err['hinh'] : '') ?>
      </div>
      <div class="form-group">
        <label for="inputClientCompany">SLider4</label>
        <input type="file" name="ten_slide4" class="form-control">
        <?= (isset($err['hinh']) ? $err['hinh'] : '') ?>
      </div>
      <div class="form-group">
        <label for="inputClientCompany">SLider5</label>
        <input type="file" name="ten_slide5" class="form-control">
        <?= (isset($err['hinh']) ? $err['hinh'] : '') ?>
      </div>
    </div>
  </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">

        <input type="submit" name="btnSave" value="Create New" class="btn btn-success ml-2 float-right">
        <button class="btn btn-secondary float-right ml-2 " type="reset">Reset</button>
        <a href="?module=backend&controller=product&action=list" type="input" class="btn btn-primary float-right"><i class="fas fa-list-ul"> List</i></a>
      </div>
    </div>
  </section>
  <!-- /.content -->
</form>