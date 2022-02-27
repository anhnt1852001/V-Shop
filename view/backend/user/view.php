<?php
$user = user_get_one(['ma_kh' => $_GET['id']]);
?>
<h4 class="text-center card-header text-success"><?php echo @$msg; ?></h4>
<section class="content row">
  <!-- Widget: user widget style 1 -->
  <div class="col-md-3"></div>
  <div class="card card-widget widget-user col-md-6">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-info">
      <h3 class="widget-user-username"><?= $user['ho_ten'] ?></h3>
      <h5 class="widget-user-desc">
        <?php if ($user['vai_tro'] == 1) {
          echo '<i class="fas fa-user-shield"></i>Nhân Viên';
        } else {
          echo 'Khách Hàng';
        }
        ?>
      </h5>
    </div>
    <div class="widget-user-image">
      <img class="img-circle elevation-2" src="<?= BASE_URL ?>/public/content/images/user/<?= $user['hinh'] ?>" alt="User Avatar">
    </div>
    <div class="card-footer">
      <strong><i class="fas fa-envelope-open-text"></i> Email</strong>
      <p class="text-muted"><?= $user['email'] ?></p>
      <hr>
      <strong><i class="fas fa-mobile-alt"></i> Phone</strong>
      <p class="text-muted"><?= $user['so_dt'] ?></p>
      <hr>
      <strong><i class="fas fa-unlock-alt"></i> Password</strong>
      <p class="text-muted"><?= $user['mat_khau'] ?></p>
      <hr>
      <strong><i class="fas fa-toggle-on"></i>Trạng Thái
        <?php if ($user['kich_hoat'] == 1) {
          echo '<p class="text-success">Đã Kích Hoạt</p>';
        } else {
          echo '<p class="text-danger">Chưa Kích Hoạt</p>';
        }
        ?></strong>
      <!-- /.row -->
    </div>
    <a href="?module=backend&controller=user&action=edit&id=<?= $user['ma_kh'] ?>" class="btn btn-primary btn-block"><b>Thay Đổi Thông Tin</b></a>
  </div>
  <div class="col-md-3"></div>
  <!-- /.widget-user -->
</section>