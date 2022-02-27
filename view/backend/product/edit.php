<div class="card-header">
  <h3 class="card-title">
    <i class="fas fa-edit"></i>
    Sửa Thông Tin Sản Phẩm
  </h3>
</div>
<!-- /.card-header -->
<?php
require_once APP_PATH . '/model/categories_model.php';
require_once APP_PATH . '/model/trademark_model.php';
require_once APP_PATH . '/model/slide_model.php';
$product = product_get_one(['ma_hh' => $_GET['id']]);
$cate_select_list = categories_list_all();
$trademark_select_list = trademark_list_all();
$slide = slide_get_one1(['ma_hh' => $_GET['id']]);
?>
<h4 class="text-center text-success"><?php if (isset($msg)) {
                                        echo $msg;
                                      } ?></h4>

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
              <input name="ma_hh" class="form-control" readonly value="<?= $product['ma_hh'] ?>">
            </div>
            <div class="form-group">
              <label for="inputName">Tên Hàng Hóa</label>
              <input type="text" name="ten_hh" class="form-control" value="<?= $product['ten_hh'] ?>">
              <?= (isset($err['ten_hh']) ? $err['ten_hh'] : '') ?>
            </div>
            <div>
              <label>THƯƠNG HIỆU</label>
              <select class="form-control select2" name="ma_th">
                <?php
                foreach ($trademark_select_list as $trade) {
                  if ($trade['ma_th'] == $product['ma_th']) {
                    echo '<option selected value="' . $trade['ma_th'] . '">' . $trade['ten_th'] . '</option>';
                  } else {
                    echo '<option value="' . $trade['ma_th'] . '">' . $trade['ten_th'] . '</option>';
                  }
                }
                ?>
              </select>
            </div>
            <div>
              <label>LOẠI HÀNG</label>
              <select class="form-control select2" name="ma_mh">
                <?php
                foreach ($cate_select_list as $cate) {
                  if ($cate['ma_mh'] == $product['ma_mh']) {
                    echo '<option selected value="' . $cate['ma_mh'] . '">' . $cate['ten_mh'] . '</option>';
                  } else {
                    echo '<option value="' . $cate['ma_mh'] . '">' . $cate['ten_mh'] . '</option>';
                  }
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Đơn Giá</label>
              <input type="number" name="don_gia" class="form-control" value="<?= $product['don_gia'] ?>">
              <?= (isset($err['don_gia']) ? $err['don_gia'] : '') ?>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Giảm Giá</label>
              <input type="number" name="giam_gia" class="form-control" value="<?= $product['giam_gia'] ?>">
              <?= (isset($err['giam_gia']) ? $err['giam_gia'] : '') ?>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Hình</label>
              <input name="hinh" type="hidden" value="<?= $product['hinh'] ?>">
              <input type="file" name="up_hinh" class="form-control">(<?= $product['hinh'] ?>)
              <?= (isset($err['hinh']) ? $err['hinh'] : '') ?>
            </div>
            //mới thêm
            <div class="form-group">
              <label for="inputClientCompany">Banner</label>
              <input name="banner" type="hidden" value="<?= $product['banner'] ?>">
              <input type="file" name="up_banner" class="form-control">(<?= $product['banner'] ?>)
              <?= (isset($err['banner']) ? $err['banner'] : '') ?>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Ram</label>
              <input type="number" name="ram" class="form-control"value="<?= $product['ram'] ?>">
              <?= (isset($err['ram']) ? $err['ram'] : '') ?>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Storage</label>
              <input type="number" name="storage" class="form-control" value="<?= $product['storage'] ?>">
              <?= (isset($err['storage']) ? $err['storage'] : '') ?>
            </div>
            <div class="form-group">
              <label>Status</label> <br>
              <label>
                <input <?= !$product['status'] ? 'checked' : '' ?> name="status" value="1" type="radio">
                Hàng bán
              </label>
              <label>
                <input <?= $product['status'] ? 'checked' : '' ?> name="status" value="0" type="radio">
                Hàng Giới Thiệu
              </label>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Số Lượng</label>
              <input type="number" name="so_luong" class="form-control"value="<?= $product['so_luong'] ?>">
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
              <input type="date" name="ngay_nhap" class="form-control" value="<?= $product['ngay_nhap'] ?>">
              <?= (isset($err['ngay_nhap']) ? $err['ngay_nhap'] : '') ?>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Số Lượt Xem</label>
              <input readonly name="so_luot_xem" value="0" class="form-control" value="<?= $product['so_luot_xem'] ?>">
            </div>
            <div class="form-group">
              <label>Hàng Đặc Biệt</label> <br>
              <label>
                <input <?= !$product['dac_biet'] ? 'checked' : '' ?> name="dac_biet" value="0" type="radio">
                Bình Thường
              </label>
              <label>
                <input <?= $product['dac_biet'] ? 'checked' : '' ?> name="dac_biet" value="1" type="radio">
                Đặc Biệt
              </label>
            </div>
            <div class="form-group">
              <label for="inputEstimatedBudget">Mô Tả</label>
              <textarea class="textarea" name="mo_ta" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $product['mo_ta'] ?></textarea>
              <?= (isset($err['mo_ta']) ? $err['mo_ta'] : '') ?>
            </div>
          </div>
        </div>
        <!-- //file slide -->
        <!-- /.card -->

        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Files</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <?php if (isset($slide['ma_hh'])) : ?>
            <?php if ($slide['ma_hh'] == $product['ma_hh']) : ?>
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>File </th>
                      <th>File Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <img src="<?= BASE_URL ?>/public/content/images/slides/<?= $slide['ten_slide1'] ?>" width="50px" alt="">
                      </td>
                      <td><?= $slide['ten_slide1'] ?></td>
                    </tr>
                    <tr>
                      <td>
                        <img src="<?= BASE_URL ?>/public/content/images/slides/<?= $slide['ten_slide2'] ?>" width="50px" alt="">
                      </td>
                      <td><?= $slide['ten_slide2'] ?></td>
                    </tr>
                    <tr>
                      <td>
                        <img src="<?= BASE_URL ?>/public/content/images/slides/<?= $slide['ten_slide3'] ?>" width="50px" alt="">
                      </td>
                      <td><?= $slide['ten_slide3'] ?></td>
                    </tr>
                    <tr>
                      <td>
                        <img src="<?= BASE_URL ?>/public/content/images/slides/<?= $slide['ten_slide4'] ?>" width="50px" alt="">
                      </td>
                      <td><?= $slide['ten_slide4'] ?></td>
                    </tr>
                    <tr>
                      <td>
                        <img src="<?= BASE_URL ?>/public/content/images/slides/<?= $slide['ten_slide5'] ?>" width="50px" alt="">
                      </td>
                      <td><?= $slide['ten_slide5'] ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            <?php endif; ?>
          <?php else : ?>
            <p class="mt-3 ml-3 ">Bạn chưa có slide cho sản phẩm :<?= $product['ten_hh'] ?> <a class="btn btn-info float-right mr-1" href="?module=backend&controller=slide&action=add&id=<?= $product['ma_hh'] ?>">
            <i class="fas fa-images"></i>
                Thêm Slide
              </a></p>
          <?php endif; ?>

        </div>
        <!-- /.card -->

        <!-- end file slide -->

      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <input type="submit" name="btnSave" value="Save" class="btn btn-success ml-2 float-right">
        <button class="btn btn-secondary float-right ml-2 " type="reset">Reset</button>
        <a href="?module=backend&controller=product&action=list" type="input" class="btn btn-primary float-right"><i class="fas fa-list-ul"> List</i></a>
      </div>
    </div>
  </section>
  <!-- /.content -->
</form>