<div class="card-header">
    <h3 class="card-title">
        <i class="ion ion-clipboard mr-1"></i>
        Danh sách Slide
    </h3>

    <div class="card-tools">
        <ul class=" pagination pagination-sm ">
            <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=slide&action=list&page_no=1">|&lt;</a></li>
            <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=slide&action=list&page_no=<?= $_SESSION['prev_page'] ?>">
                    <<</a> </li> <?php for ($i = 1; $i <= $_SESSION['total_page']; $i++)
                                        echo '<li class="page-item"><a class="page-link"  href="?module=backend&controller=slide&action=list&page_no=' . $i . '">' . $i . '</a></li>  '
                                    ?> <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=slide&action=list&page_no=<?= $_SESSION['next_page'] ?>">>></a></li>
            <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?module=backend&controller=slide&action=list&page_no=<?= $_SESSION['total_page'] ?>">>|</a></li>
        </ul>
    </div>
</div>
<!-- /.card-header -->
<form action="" method="post">
    <table class="table table-striped projects">
        <thead>
            <tr class="text-center">
                <th></th>
                <th>Mã Slide</th>
                <th>Mã Hàng Hóa</th>
                <th>Tên Slide1</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list_slide as $row) : ?>
                <tr class="text-center">
                    <td><input type="checkbox" name="ma_slide[]" value="<?= $row['ma_slide'] ?>"></td>
                    <td><?= $row['ma_slide'] ?></td>
                    <?php
                    foreach ($list_product as $product) {
                        if ($product['ma_hh'] == $row['ma_hh']) {
                            echo '<td>' . $product['ten_hh'] . '</td>';
                        }
                    }
                    ?>
                    <td>
                        <div class="justify-content-center product-image-thumbs">
                            <div class="product-image-thumb active"><img src="<?= BASE_URL ?>/public/content/images/slides/<?= $row['ten_slide1'] ?>" alt="Slide Image"></div>
                            <div class="product-image-thumb active"><img src="<?= BASE_URL ?>/public/content/images/slides/<?= $row['ten_slide2'] ?>" alt="Slide Image"></div>
                            <div class="product-image-thumb active"><img src="<?= BASE_URL ?>/public/content/images/slides/<?= $row['ten_slide3'] ?>" alt="Slide Image"></div>
                            <div class="product-image-thumb active"><img src="<?= BASE_URL ?>/public/content/images/slides/<?= $row['ten_slide4'] ?>" alt="Slide Image"></div>
                            <div class="product-image-thumb active"><img src="<?= BASE_URL ?>/public/content/images/slides/<?= $row['ten_slide5'] ?>" alt="Slide Image"></div>
                        </div>
                    </td>
                    <td class="project-actions ">
                        <a class="btn btn-info btn-sm" href="?module=backend&controller=slide&action=edit&id=<?= $row['ma_slide'] ?>">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-danger btn-sm" href="?module=backend&controller=slide&action=delete&id=<?= $row['ma_slide'] ?>">
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
                <td colspan="7">
                    <button class="btn btn-dark" id="check-all" type="button">Chọn tất cả</button>
                    <button class="btn btn-dark" id="clear-all" type="button">Bỏ chọn tất cả</button>
                    <button onclick="return confirm('Bạn có muốn xóa  không ?')" class="btn btn-danger" id="btn-delete" name="btn-delete-multi"> <i class="fas fa-trash"></i> Xóa các mục chọn</button>
                    <a class="btn btn-info" href="?module=backend&controller=slide&action=add">
                        <i class="fas fa-plus"></i>
                        Thêm
                    </a>
                </td>
            </tr>
        </tfoot>
    </table>
</form>