<?php if (isset($_SESSION['cart'])) : ?>
    <div class="bg-light border shadow mt-3 px-3 py-2">
        <form action="" method="post">
            <div class="form-group">
                <div class="text-center border-bottom p-3">
                    <p class="font-weight-bold">Lập đơn hàng</p>
                </div>
                <div class="row">
                    <div class="col-6 border-right mt-2">
                        <label class="mt-4 mb-2" for="">Người Lập đơn</label>
                        <input class="form-control" type="text" readonly name="nguoi_lap_don" value="<?= $_SESSION['ma_kh']['ho_ten'] ?>">
                        <input class="form-control" type="hidden" name="ma_hd">
                        <label class="mt-4 mb-1 " for="">Tên Người Nhận *</label>
                        <input class="form-control" type="text" name="nguoi_nhan">
                        <label class="mt-4 mb-2 " for="">SDT Người nhận *</label>
                        <input class="form-control" type="text" name="sdt">
                        <label class="mt-4 mb-2 " for="">Địa Chỉ *</label>
                        <input class="form-control" type="text" name="dia_chi">
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="hidden" name="trang_thai" value="0">
                        <?php foreach ($_SESSION['cart'] as $key => $SP) {
                            $ttsp = infoSP($SP['ma_hh']);
                            print_r($_SESSION['cart']);
                        ?>
                            <input class="form-control" type="hidden" name="ma_hh" value="<?= $ttsp['ma_hh'] ?>">
                            <input class="form-control" type="hidden" name="so_luong" value="<?= $SP['sl'] ?>">
                            <input class="form-control" type="hidden" name="don_gia" value="<?= $ttsp['don_gia'] ?>">
                            <div class="p-3">
                                <div class="d-flex justify-content-between py-3 px-2 border-bottom">
                                    <span>san pham</span>
                                    <span>tong</span>
                                </div>
                                <div class="d-flex justify-content-between py-3 px-2">
                                    <div>
                                        <span>
                                            san pham 1
                                        </span>
                                    </div>
                                    <div>
                                        <span>400</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between py-3 px-2 border-top">
                                    <div>
                                        <span class="font-weight-bold">
                                            tổng đơn hàng
                                        </span>
                                    </div>
                                    <div>
                                        <span class="font-weight-bold text-danger">400</span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="mt-3 btn btn-sm btn-primary" name="send_cart">Gửi Đơn</button>
                </div>
            </div>
        </form>
    </div>
<?php else : ?>
    <?php if (isset($c)) echo '<h4>' . $c . '</h4>' ?>
<?php endif; ?>