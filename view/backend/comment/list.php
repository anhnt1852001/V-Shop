<div class="card-header">
    <h3 class="card-title">
        <i class="ion ion-clipboard mr-1"></i>
        Danh sách Bình Luận
    </h3>

    <div class="card-tools">
        <ul class=" pagination pagination-sm ">
            <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=comment&action=list&page_no=1">|&lt;</a></li>
            <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=comment&action=list&page_no=<?= $_SESSION['prev_page'] ?>">
                    <<</a> </li> <?php for ($i = 1; $i <= $_SESSION['total_page']; $i++)
                                        echo '<li class="page-item"><a class="page-link"  href="?module=backend&controller=comment&action=list&page_no=' . $i . '">' . $i . '</a></li>  '
                                    ?> <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=comment&action=list&page_no=<?= $_SESSION['next_page'] ?>">>></a></li>
            <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=comment&action=list&page_no=<?= $_SESSION['total_page'] ?>">>|</a></li>
        </ul>
    </div>
</div>
<!-- /.card-header -->
<form action="" method="post">
    <table class="table table-striped projects">
        <thead>
            <tr class="text-center">
                <th>Hàng Hóa</th>
                <th>Số Bình Luận</th>
                <th>Mới Nhất</th>
                <th>Cũ Nhất</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list_comment as $cmt) : ?>
                <tr class="text-center">
                    <td><?= $cmt['ten_hh'] ?></td>
                    <td><?= $cmt['so_luong'] ?></td>
                    <td><?= $cmt['moi_nhat'] ?></td>
                    <td><?= $cmt['cu_nhat'] ?></td>
                    <td class="project-actions ">
                        <a class="btn btn-info btn-sm" href="?module=backend&controller=comment&action=detail&id=<?= $cmt['ma_hh'] ?>">
                            <i class="fas fa-info-circle"></i>
                            Detail
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>

