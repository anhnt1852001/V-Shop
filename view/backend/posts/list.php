<h3 class="card-title">
    <i class="ion ion-clipboard mr-1"></i>
    Danh sách bài viết
</h3>
<form action="" method="post">
    <table id="example1" class="table table-hover">
        <thead>
            <tr class="table-success">
                <th></th>
                <th>Mã Bài Viết</th>
                <th>Tên Bài Viết</th>
                <th>Tên Hàng Hóa</th>
                <th>Ngày Đăng Bài</th>
                <th>Lượt Xem</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list_posts as $row) : ?>
                <tr>
                    <td><input type="checkbox" name="ma_bv[]" value="<?= $row['ma_bv'] ?>"></td>
                    <td><?= $row['ma_bv'] ?></td>
                    <td><?= $row['ten_bv'] ?></td>
                    <?php
                    foreach ($list_product as $product) {
                        if ($product['ma_hh'] == $row['ma_hh']) {
                            echo '<td>' . $product['ten_hh'] . '</td>';
                        }
                    }
                    ?>
                    <td><?= $row['ngay_db'] ?></td>
                    <td><?= $row['luot_xem'] ?></td>
                    <td class="project-actions text-center ">
                        <a class="btn btn-primary btn-sm" href="?module=backend&controller=posts&action=view&id=<?= $row['ma_bv'] ?>">
                            <i class="fas fa-eye">
                            </i>
                            View
                        </a>
                        <a class="btn btn-info btn-sm" href="?module=backend&controller=posts&action=edit&id=<?= $row['ma_bv'] ?>">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-danger btn-sm" href="?module=backend&controller=posts&action=delete&id=<?= $row['ma_bv'] ?>">
                            <i class="fas fa-trash">
                            </i>
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">
                    <button class="btn btn-dark" id="check-all" type="button">Chọn tất cả</button>
                    <button class="btn btn-dark" id="clear-all" type="button">Bỏ chọn tất cả</button>
                    <button onclick="return confirm('Bạn có muốn xóa  không ?')" class="btn btn-danger" id="btn-delete" name="btn-delete-multi"> <i class="fas fa-trash"></i> Xóa các mục chọn</button>
                    <a class="btn btn-info" href="?module=backend&controller=posts&action=add">
                        <i class="fas fa-plus"></i>
                        Thêm
                    </a>
                </td>
                <td colspan="1">
                    <ul class=" pagination">
                        <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=posts&action=list&page_no=1">|&lt;</a></li>
                        <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=posts&action=list&page_no=<?= $_SESSION['prev_page'] ?>">
                                <<</a> </li> <?php for ($i = 1; $i <= $_SESSION['total_page']; $i++)
                                                    echo '<li class="page-item"><a class="page-link"  href="?module=backend&controller=posts&action=list&page_no=' . $i . '">' . $i . '</a></li>  '
                                                ?> <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=posts&action=list&page_no=<?= $_SESSION['next_page'] ?>">>></a></li>
                        <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=posts&action=list&page_no=<?= $_SESSION['total_page'] ?>">>|</a></li>
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>
</form>