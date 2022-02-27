<!-- <h3 class="bg-light p-4  border-bottom mt-3 font-weight-bold">
    Đăng ký
</h3> -->
<div class="container bg-light">
    <div class="row mt-3 bg-light border-bottom mt-3 p-4 d-flex justify-content-between">
        <div class="">
            <p class="text-uppercase font-weight-bold">đăng ký</p>
        </div>
        <div class="">
            <span>Bạn đã có tài khoản? </span>
            <a class="text-primary" href="<?= BASE_URL ?>/?controller=user&action=login">Đăng nhập</a>
            <span> tại đây</span>
        </div>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- content -->
        <section class=" pt-3 px-3">
            <h4 class="text-center  text-success my-4"><?php echo @$msg; ?></h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputName">Mã Khách Hàng</label>
                        <input type="text" name="ma_kh" class="form-control">
                        <?= (isset($err['ma_kh']) ? $err['ma_kh'] : '') ?>
                    </div>
                    <div class="form-group">
                        <label for="inputName">Họ Tên</label>
                        <input type="text" name="ho_ten" class="form-control">
                        <?= (isset($err['ho_ten']) ? $err['ho_ten'] : '') ?>
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Mật Khẩu</label>
                        <input type="password" name="mat_khau" class="form-control">
                        <?= (isset($err['mat_khau']) ? $err['mat_khau'] : '') ?>
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Xác Nhận Mật Khẩu</label>
                        <input type="password" name="mat_khau2" class="form-control">
                        <?= (isset($err['mat_khau2']) ? $err['mat_khau2'] : '') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputClientCompany">Avatar</label>
                        <input type="file" name="hinh" class="form-control">
                        <?= (isset($err['hinh']) ? $err['hinh'] : '') ?>
                    </div>
                    <div class="form-group">
                        <label for="inputEstimatedBudget">Email</label>
                        <input type="text" name="email" class="form-control">
                        <?= (isset($err['email']) ? $err['email'] : '') ?>
                    </div>
                    <div class="form-group">
                        <label for="inputSpentBudget">Số Điện Thoại</label>
                        <input type="text" name="so_dt" class="form-control">
                        <?= (isset($err['so_dt']) ? $err['so_dt'] : '') ?>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="vai_tro" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="kick_hoat" value="" class="form-control">
                    </div>
                </div>
            </div>
            <div class="pb-3 mt-3 text-center col-4 offset-4">
                <input type="submit" name="btnSave" value="Đăng ký" class="btn btn-success btn-block">
            </div>
        </section>
        <!-- /.content -->
</div>
</form>