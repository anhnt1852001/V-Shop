<div class="card-header">
    <h3 class="card-title">
        <i class="ion ion-clipboard mr-1"></i>
        Chi Tiết Bình Luận
    </h3>
</div>
<!-- <h4 class="text-center card-header text-success"><?php echo $kqxoa ?></h4> -->
<!-- /.card-header -->
<form action="" method="post">
    <div class="card-body table-responsive p-0" style="height: 400px;">
        <table class="table table-striped projects  table-head-fixed text-nowrap">
            <thead>
                <tr class="text-center">
                    <th></th>
                    <th>Nội Dung</th>
                    <th>Ngày Bình Luận</th>
                    <th>Người Bình Luận</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail_comment as $detail_cmt) : ?>
                    <tr class="text-center">
                        <td><input type="checkbox" name="ma_bl[]" value="<?= $detail_cmt['ma_bl'] ?>"></td>
                        <td><?= $detail_cmt['noi_dung'] ?></td>
                        <td><?= $detail_cmt['ngay_bl'] ?></td>
                        <td><?= $detail_cmt['ma_kh'] ?></td>
                        <td class="project-actions ">
                            <a onclick="return confirm('Bạn có muốn xóa  không ?')" class="btn btn-danger btn-sm" href="?module=backend&controller=comment&action=delete&id=<?= $detail_cmt['ma_bl'] ?>">
                                <i class="fas fa-delete"></i>
                                DELETE
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        <button class="btn btn-dark" id="check-all" type="button">Chọn tất cả</button>
        <button class="btn btn-dark" id="clear-all" type="button">Bỏ chọn tất cả</button>
        <button onclick="return confirm('Bạn có muốn xóa  không ?')" class="btn btn-danger" id="btn-delete" name="btn-delete-multi"> <i class="fas fa-trash"></i> Xóa các mục chọn</button>
        <a class="btn btn-info" href="?module=backend&controller=comment&action=list">
            <i class="fas fa-comments"></i>
            Danh Sách Comment
        </a>
    </div>

</form>