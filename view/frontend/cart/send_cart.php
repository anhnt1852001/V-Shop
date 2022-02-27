<?php if (isset($_SESSION['cart'])) : ?>
    <?php $tongtien = 0; ?>
    <div class="bg-light border shadow mt-3 px-3 py-2">
        <form action="" method="post">
            <div class="form-group">
                <div class="text-center border-bottom p-3">
                    <p class="font-weight-bold">Lập đơn hàng</p>
                </div>
                <div class="row pt-2">
                    <div class="col-6 border-right mt-2">
                        <label class="mb-2" for="">Người Lập đơn</label>
                        <input class="form-control" type="text" readonly name="nguoi_lap_don" value="<?= $_SESSION['ma_kh']['ho_ten'] ?>">
                        <input class="form-control" type="hidden" name="ma_hd">
                        <label class="mt-4 mb-2 " for="">Tên Người Nhận *</label>
                        <input class="form-control" type="text" name="nguoi_nhan">
                        <?= (isset($err['nguoi_nhan']) ? $err['nguoi_nhan'] : '') ?> <br>
                        <label class="mt-2 mb-2 " for="">SDT Người nhận *</label>
                        <input class="form-control" type="text" name="sdt">
                        <?= (isset($err['sdt']) ? $err['sdt'] : '') ?> <br>
                        <label class="mt-2 mb-2 " for="">Địa Chỉ *</label>
                        <input class="form-control" type="text" name="dia_chi">
                        <?= (isset($err['dia_chi']) ? $err['dia_chi'] : '') ?> <br>
                    </div>
                    <div class="col-6" style="font-size: 0.9rem;">
                        <input class="form-control" type="hidden" name="trang_thai" value="0">
                        <?php foreach ($_SESSION['cart'] as $key => $SP) {
                            $ttsp = infoSP($SP['ma_hh']);
                        ?>
                            <input class="form-control" type="hidden" name="ma_hh" value="<?= $ttsp['ma_hh'] ?>">
                            <input class="form-control" type="hidden" name="so_luong" value="<?= $SP['sl'] ?>">
                            <?php if ($ttsp['giam_gia'] == 0) : ?>
                                <input class="form-control" type="hidden" name="don_gia" value="<?= $ttsp['don_gia'] ?>">
                            <?php else : ?>
                                <input class="form-control" type="hidden" name="don_gia" value="<?= ($ttsp['don_gia'] * (1 - $ttsp['giam_gia'] * 0.01)) ?>">
                            <?php endif; ?>
                        <?php } ?>

                        <table class="table mb-1">
                            <thead>
                                <th>Sản Phẩm</th>
                                <th>SL</th>
                                <th>Đơn Giá</th>
                            </thead>
                            <tbody>
                                <?php foreach ($_SESSION['cart'] as $key => $SP) {
                                    $ttsp = infoSP($SP['ma_hh']);
                                ?>
                                    <tr>
                                        <td>
                                            <span>
                                                <?php if ($ttsp['giam_gia'] == 0) : ?>
                                                    <?= $ttsp['ten_hh'] ?>
                                                <?php else : ?>
                                                    <?= $ttsp['ten_hh'] ?>
                                                    <span class="right badge badge-danger"> - <?= $ttsp['giam_gia'] ?>%</span>
                                                <?php endif; ?>
                                                <input type="hidden" name="ten_hh" value="<?= $ttsp['ten_hh'] ?>">
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?= $SP['sl'] ?>
                                            </span>
                                        </td>
                                        <td style="width: 145px;">
                                            <span><?= number_format($ttsp['don_gia'] * (1 - $ttsp['giam_gia'] * 0.01)) ?> đ</span>
                                        </td>
                                    </tr>
                                    <span hidden><?= $tongtien += ($ttsp['don_gia'] * (1 - $ttsp['giam_gia'] * 0.01) * $SP['sl']); ?></span>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <span>
                                            Tổng Tiền
                                        </span>
                                    </td>
                                    <td></td>
                                    <td>
                                        <span class=""><?= number_format($tongtien) ?>đ</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="">
                                            Tiền Ship
                                        </span>
                                    </td>
                                    <td></td>
                                    <td>
                                        <span class="">50,000đ</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="font-weight-bold">
                                            Tổng Hóa Đơn
                                        </span>
                                    </td>
                                    <td></td>
                                    <td>
                                        <span class="font-weight-bold "><?= number_format($tongtien + 50000) ?>đ</span>
                                        <input type="hidden" name="tong_tien" value="<?= $tongtien + 50000 ?>">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
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