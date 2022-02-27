
<div class="card-header">
    <h3 class="card-title">
        <i class="ion ion-clipboard mr-1"></i>
        Danh sách khách hàng  
    </h3>
    <a class="btn btn-info float-right" href="?module=backend&controller=user&action=add">
                <i class="fas fa-plus"></i>
                        Thêm
                    </a>
</div>

<h4 class="text-center  text-success"><?php echo @$msg; ?></h4>
<section class="content">
  <div class="card-body">
    <div class="row d-flex align-items-stretch">
      <?php foreach ($list_user as $user) : ?>
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
          <div class="card bg-light">
            <div class="card-header text-muted border-bottom-0">
              <?php
              if ($user['vai_tro'] == 1) {
                echo '<i class="fas fa-star"></i><b>Nhân Viên</b>';
              } else {
                echo 'Khách Hàng';
              }
              ?>
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-7">
                  <h2 class="lead"><b><?= $user['ho_ten'] ?></b></h2>
                  <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                  <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><i class="fas fa-key"></i></span>Password:<?=$user['mat_khau']?></li>
                    <li class="small"><span class="fa-li"><i class="fas fa-envelope-open-text"></i></span>Email:<?=$user['email']?></li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone:<?= $user['so_dt'] ?></li>
                  </ul>
                </div>
                <div class="col-5 text-center">
                  <img src="<?= BASE_URL ?>/public/content/images/user/<?= $user['hinh'] ?>" alt="" class="img-circle img-fluid">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="text-right">
                <a class="btn btn-info btn-sm" href="?module=backend&controller=user&action=edit&id=<?= $user['ma_kh'] ?>">
                  <i class="fas fa-pencil-alt">
                  </i>
                  Edit
                </a>
                <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-danger btn-sm" href="?module=backend&controller=user&action=delete&id=<?= $user['ma_kh'] ?>">
                  <i class="fas fa-trash">
                  </i>
                  Delete
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
    <!-- // phân trang -->
    <div class="card-footer">
    <ul class="pagination justify-content-center m-0">
            <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=user&action=list&page_no=1">|&lt;</a></li>
            <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=user&action=list&page_no=<?= $_SESSION['prev_page'] ?>">
                    <<</a> </li> <?php for ($i = 1; $i <= $_SESSION['total_page']; $i++)
                                        echo '<li class="page-item"><a class="page-link"  href="?module=backend&controller=user&action=list&page_no=' . $i . '">' . $i . '</a></li>  '
                                    ?> <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=user&action=list&page_no=<?= $_SESSION['next_page'] ?>">>></a></li>
            <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=user&action=list&page_no=<?= $_SESSION['total_page'] ?>">>|</a></li>
        </ul>
    </div>
</section>
