<?php
require_once APP_PATH . '/model/product_model.php';
$product_select_list = product_list_all();
?>
<div class="card-header">
    <h3 class="card-title">
        <i class="fas fa-plus-circle"></i>
        Thêm Slide
    </h3>
</div>

<!-- /.card-header -->
<h4 class="text-center card-header text-success"><?php echo @$msg; ?></h4>
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
                            <label for="inputName">Mã Slide</label>
                            <input name="ma_slide" class="form-control" readonly value="auto number">
                        </div>
                        <div>
                            <label>Mã Hàng Hóa</label>
                            <?php if (isset($_GET['id'])) : ?>
                                <input class="form-control" name="ma_hh" readonly value="<?= $_GET['id'] ?>">
                            <?php else : ?>
                                <select class="form-control select2"  name="ma_hh">
                                    <?php
                                    foreach ($product_select_list as $product) {
                                        echo '<option  value="' . $product['ma_hh'] . '">' . $product['ten_hh'] . '</option>';
                                    }
                                    ?>
                                </select>
                            <?php endif; ?>
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
                            <label for="inputName">Slide 1</label>
                            <input type="file" name="ten_slide1" class="form-control">
                            <?= (isset($err['ten_slide1']) ? $err['ten_slide1'] : '') ?>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Slide 2</label>
                            <input type="file" name="ten_slide2" class="form-control">
                            <?= (isset($err['ten_slide2']) ? $err['ten_slide2'] : '') ?>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Slide 3</label>
                            <input type="file" name="ten_slide3" class="form-control">
                            <?= (isset($err['ten_slide3']) ? $err['ten_slide3'] : '') ?>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Slide 4</label>
                            <input type="file" name="ten_slide4" class="form-control">
                            <?= (isset($err['ten_slide4']) ? $err['ten_slide4'] : '') ?>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Slide 5</label>
                            <input type="file" name="ten_slide5" class="form-control">
                            <?= (isset($err['ten_slide5']) ? $err['ten_slide5'] : '') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <input type="submit" name="btnSave" value="Create New" class="btn btn-success ml-2 float-right">
                <button class="btn btn-secondary float-right ml-2 " type="reset">Reset</button>
                <a href="?module=backend&controller=slide&action=list" type="input" class="btn btn-primary float-right"><i class="fas fa-list-ul"> List</i></a>
                <?php if (isset($_GET['id'])) : ?>
                    <a href="?module=backend&controller=product&action=edit&id=<?= $_GET['id'] ?>" type="input" class="btn btn-primary float-right float-right mr-2"><i class="fas fa-undo-alt"></i>Quay Lại Edit Sản Phẩm</i></a>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- /.content -->
</form>