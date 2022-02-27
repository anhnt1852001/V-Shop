<form action="" method="post">
    <table id="example1" class="table table-hover">
        <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            Danh sách Hoá Đơn
        </h3>
        <thead>
            <tr class="text-center">
                <th>Mã Hóa Đơn</th>
                <th>Người Nhận</th>
                <th>SDT</th>
                <th>Địa Chỉ</th>
                <th>Người Lập Đơn</th>
                <th>Ngày Lập Đơn</th>
                <th>Trạng Thái</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list_order as $cmt) { ?>
                <tr class="text-center">
                    <td><?= $cmt['ma_hd'] ?></td>
                    <td><?= $cmt['nguoi_nhan'] ?></td>
                    <td><?= $cmt['sdt'] ?></td>
                    <td><?= $cmt['dia_chi'] ?></td>
                    <td><?= $cmt['nguoi_lap_don'] ?></td>
                    <td><?= $cmt['ngay_lap_don'] ?></td>
                    <td> <?php if ($cmt['trang_thai'] == 0) {
                                echo '<span class="badge badge-warning">Đang Chờ Xác Nhận</span>';
                            } else if ($cmt['trang_thai'] == 1) {
                                echo '<span class="badge badge-info">Đang Giao Hàng</span>';
                            } else if ($cmt['trang_thai'] == 2) {
                                echo '<span class="badge badge-success">Đã Thanh Toán</span>';
                            }
                            ?></td>
                    <td>
                        <a class="btn btn-info btn-sm" href="?module=backend&controller=order&action=detail&id=<?= $cmt['ma_hd'] ?>">
                            <i class="fas fa-info-circle"></i>
                            Detail
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
            <td colspan="8">
                <ul class=" pagination pagination-sm">
                    <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=order&action=list&page_no=1">|&lt;</a></li>
                    <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=order&action=list&page_no=<?= $_SESSION['prev_page'] ?>">
                            <<</a> </li> <?php for ($i = 1; $i <= $_SESSION['total_page']; $i++)
                                                echo '<li class="page-item"><a class="page-link"  href="?module=backend&controller=order&action=list&page_no=' . $i . '">' . $i . '</a></li>  '
                                            ?> <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=order&action=list&page_no=<?= $_SESSION['next_page'] ?>">>></a></li>
                    <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=order&action=list&page_no=<?= $_SESSION['total_page'] ?>">>|</a></li>
                </ul>
                </td>
            </tr>
        </tfoot>
    </table>
</form>