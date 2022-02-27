<div class="card-header">
    <h3 class="card-title">
        <i class="ion ion-clipboard mr-1"></i>
        Chi Tiết Hóa Đơn
    </h3>
</div>
<!-- <h4 class="text-center card-header text-success"><?php echo $kqxoa ?></h4> -->
<!-- /.card-header -->
<form action="" method="post">
    <div class="card-body table-responsive p-0" style="height: 400px;">
        <table class="table table-striped projects  table-head-fixed text-nowrap">
            <thead>
                <tr class="text-center">
                    <th>Mã Hóa Đơn</th>
                    <th>Mã Hàng Hóa</th>
                    <th>Tên Hàng Hóa</th>
                    <th>Số lượng</th>
                    <th>Giá Mua</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail_order as $detail_cmt) : ?>
                    <tr class="text-center">
                        <td><?=$detail_cmt['ma_hd']?></td>
                        <td><?= $detail_cmt['ma_hh'] ?></td>
                        <td>
                            <?php foreach ($product_all as $pro) : ?>
                                <?php if ($pro['ma_hh'] == $detail_cmt['ma_hh']) : ?>
                                    <?= $pro['ten_hh'] ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td><?= $detail_cmt['so_luong']?></td>
                        <td><?= $detail_cmt['don_gia'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        <a class="btn btn-info" href="?module=backend&controller=order&action=list">
            <i class="fas fa-orders"></i>
            Danh Sách Order
        </a>
    </div>

</form>