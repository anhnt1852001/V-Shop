<div class="card-header">
  <h3 class="card-title">
  <i class="far fa-edit"></i>
    Chỉnh Sửa Bài Viết
  </h3>
</div>
<h4 class="text-center card-header text-success"><?php echo @$msg; ?></h4>
<!-- /.card-header -->
<?php 
require_once APP_PATH . '/model/product_model.php';
$posts=posts_get_one(['ma_bv'=>$_GET['id']]);
$product_select_list =product_list_all();
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
              <label for="inputName">Mã Bài Viết</label>
              <input name="ma_bv" class="form-control" readonly value="<?=$posts['ma_bv']?>">
            </div>
            <div class="form-group">
              <label for="inputName">Tên Bài Viết</label>
              <input type="text" name="ten_bv" class="form-control" value="<?=$posts['ten_bv']?>">
              <?= (isset($err['ten_bv']) ? $err['ten_bv'] : '') ?> 
            </div>
            <div>
              <label>Mã Hàng Hóa</label>
              <select class="form-control" name="ma_hh">
              <?php
                foreach ($product_select_list as $product) {
                    if($product['ma_hh'] == $posts['ma_hh']){
                        echo '<option selected value="'.$product['ma_hh'].'">'.$product['ten_hh'].'</option>';
                    }
                    else{
                        echo '<option value="'.$product['ma_hh'].'">'.$product['ten_hh'].'</option>';
                    }
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Mô Tả</label>
              <input type="text" name="mo_ta" class="form-control" value="<?=$posts['mo_ta']?>">
              <?= (isset($err['mo_ta']) ? $err['mo_ta'] : '') ?> 
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Hình</label>
              <input name="hinh" type="hidden" value="<?= $posts['hinh'] ?>">
              <input type="file" name="up_hinh" class="form-control">(<?= $posts['hinh'] ?>)
              <?= (isset($err['hinh']) ? $err['hinh'] : '') ?> 
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
              <label for="inputClientCompany">Ngày Đăng Bài</label>
              <input type="date" name="ngay_db" class="form-control" value="<?=$posts['ngay_db']?>">
              <?= (isset($err['ngay_db']) ? $err['ngay_db'] : '') ?> 
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Số Lượt Xem</label>
              <input readonly name="luot_xem" value="0" class="form-control" value="<?=['luot_xem']?>">
            </div>
            <div class="form-group">
              <label for="inputEstimatedBudget">Nội dung</label>
              <textarea class="textarea" name="noi_dung" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?=$posts['noi_dung']?></textarea>
              <?= (isset($err['noi_dung']) ? $err['noi_dung'] : '') ?> 
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
      
        <input type="submit" name="btnSave" value="Save" class="btn btn-success ml-2 float-right">
        <button class="btn btn-secondary float-right ml-2 " type="reset">Reset</button>
        <a href="?module=backend&controller=posts&action=list" type="input" class="btn btn-primary float-right"><i class="fas fa-list-ul"> List</i></a>
      </div>
    </div>
  </section>
  <!-- /.content -->
</form>
