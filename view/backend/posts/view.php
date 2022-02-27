<?php
$posts = posts_get_one(['ma_bv' => $_GET['id']]);
?>
<!-- Box Comment -->
<div class="card card-widget">
    <div class="card-header">
        <div class="user-block">
            <span class="username">Mã hàng hóa:<a href="?module=backend&controller=product&action=view&id=<?= $posts['ma_hh'] ?>"><?=$posts['ma_hh']?></a></span>
            <span class="description">Ngày Đăng:<?=$posts['ngay_db']?></span>
        </div>
        <!-- /.user-block -->
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Mark as read">
                <i class="far fa-circle"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <img class="img-fluid pad" src="<?= BASE_URL ?>/public/content/images/posts/<?= $posts['hinh'] ?>"  alt="Photo">

        <p><?=$posts['noi_dung']?></p>
        <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
        <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
        <span class="float-right text-muted">127 likes - 3 comments</span>
    </div>
    <!-- /.card-footer -->

</div>