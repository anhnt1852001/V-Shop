<?php
require_once APP_PATH . '/model/product_model.php';
require_once APP_PATH . '/model/slide_model.php';
$product_select_list = product_list_all();
$slide = slide_get_one(['ma_slide' => $_GET['id']]);
?>
<div class="card-header">
    <h3 class="card-title">
        <i class="fas fa-plus-circle"></i>
        Chỉnh Sửa Slide
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
                            <input name="ma_slide" class="form-control" readonly value="<?= $slide['ma_slide'] ?>">
                        </div>
                        <div>
                            <label>Mã Hàng Hóa</label>
                            <select class="form-control select2" name="ma_hh">
                                <?php
                                foreach ($product_select_list as $product) {
                                    if ($product['ma_hh'] == $slide['ma_hh']) {
                                        echo '<option selected value="' . $product['ma_hh'] . '">' . $product['ten_hh'] . '</option>';
                                    } else {
                                        echo '<option value="' . $product['ma_hh'] . '">' . $product['ten_hh'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
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
                            <label for="inputClientCompany">Slide 1</label>
                            <input name="ten_slide1" type="hidden" value="<?= $slide['ten_slide1'] ?>">
                            <input type="file" name="up_ten_slide1" class="form-control">(<?= $slide['ten_slide1'] ?>)
                            <?= (isset($err['ten_slide1']) ? $err['ten_slide1'] : '') ?>
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Slide 2</label>
                            <input name="ten_slide2" type="hidden" value="<?= $slide['ten_slide2'] ?>">
                            <input type="file" name="up_ten_slide2" class="form-control">(<?= $slide['ten_slide2'] ?>)
                            <?= (isset($err['ten_slide2']) ? $err['ten_slide2'] : '') ?>
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Slide 3</label>
                            <input name="ten_slide3" type="hidden" value="<?= $slide['ten_slide3'] ?>">
                            <input type="file" name="up_ten_slide3" class="form-control">(<?= $slide['ten_slide3'] ?>)
                            <?= (isset($err['ten_slide3']) ? $err['ten_slide3'] : '') ?>
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Slide 4</label>
                            <input name="ten_slide4" type="hidden" value="<?= $slide['ten_slide4'] ?>">
                            <input type="file" name="up_ten_slide4" class="form-control">(<?= $slide['ten_slide4'] ?>)
                            <?= (isset($err['ten_slide4']) ? $err['ten_slide4'] : '') ?>
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Slide 5</label>
                            <input name="ten_slide5" type="hidden" value="<?= $slide['ten_slide5'] ?>">
                            <input type="file" name="up_ten_slide5" class="form-control">(<?= $slide['ten_slide5'] ?>)
                            <?= (isset($err['ten_slide5']) ? $err['ten_slide5'] : '') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <input type="submit" name="btnSave" value="Save" class="btn btn-success ml-2 float-right">
                <button class="btn btn-secondary float-right ml-2 " type="reset">Reset</button>
                <a href="?module=backend&controller=slide&action=list" type="input" class="btn btn-primary float-right"><i class="fas fa-list-ul"> List</i></a>
            </div>
        </div>
    </section>
    <!-- /.content -->
</form>