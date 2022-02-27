<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cart</title>
    <style>
        th {
            width: 500px;
        }
    </style>
</head>

<body>
    <div class="link">
        <div class="container">
            <div class="link__main">
                <span>Giỏ hàng</span>
            </div>
        </div>
    </div>
    <section class="container cart">
        <div class="cart__main">
            <div class="">
                <div class="cart__main--left bg-light">
                    <div class="cart__header bg-info">
                        <span>Giỏ hàng</span>
                    </div>
                    <?php $tongtien = 0;
                    if (isset($_SESSION['cart'])) {
                        $so_sp = count($_SESSION['cart']);
                    }
                    ?>
                    <table class="table table-striped">
                        <thead class="font-weight-bold">
                            <th>Hình</th>
                            <th>Tên sản phẩm</th>
                            <th></th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành Tiền</th>
                            <th>Xóa</th>
                        </thead>
                        <tbody>
                            <?php if (!empty($_SESSION['cart'])) : ?>
                                <?php foreach ($_SESSION['cart'] as $key => $SP) {
                                    $ttsp = infoSP($SP['ma_hh']);
                                ?>
                                    <tr class="">
                                        <td>
                                            <img class="img-fluid" width="120" src="<?= BASE_URL ?>/public/content/images/product/<?= $ttsp['hinh'] ?>" alt="">
                                        </td>
                                        <td colspan="2" class="text-left">
                                            <span style="max-width: 230px; min-width: 200px;" class="d-inline-block text-truncate d-block mt-3"><?= $ttsp['ten_hh'] ?></span>
                                        </td>
                                        <td style="font-size: 0.9rem;" class="pt-3">
                                            <?php if ($ttsp['giam_gia'] != '0') : ?>
                                                <span class="mt-1 mb-1 d-block font-weight-bold"><?= number_format($ttsp['don_gia'] * (1 - $ttsp['giam_gia'] * 0.01)) ?> VND</span>
                                                <span class="text-danger" style="text-decoration: line-through;"><?= number_format($ttsp['don_gia']) ?> VND</span>
                                            <?php else : ?>
                                                <span class="mt-2 d-block font-weight-bold"><?= number_format($ttsp['don_gia']) ?> VND</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="row">
                                            <input type="hidden" name="ma_hh" value="<?= $SP['ma_hh'] ?>">
                                            <input type="hidden" name="gia_mua" value="<?= $SP['don_gia'] ?>">
                                            <input class="col-5 mr-1 ml-2" name="so_luong" readonly min="0" disabled value="<?= $SP['sl'] ?>">
                                            <div class="col-3">
                                                <?php if ($SP['sl'] < $ttsp['so_luong']) : ?>
                                                    <a style="font-size:1.2rem" class="row text-decoration-none" href="<?= BASE_URL ?>/?controller=cart&action=up&id=<?= $ttsp['ma_hh'] ?>"><i class="fas fa-caret-up"></i></a>
                                                <?php else : ?>
                                                    <a style="font-size:1.2rem" class="row text-decoration-none" onclick="return confirm('Hết sản phẩm!')"><i class="fas fa-caret-up"></i></a>
                                                <?php endif; ?>

                                                <?php if ($SP['sl'] > 1) : ?>
                                                    <a style="font-size:1.2rem" class="row text-decoration-none" href="<?= BASE_URL ?>/?controller=cart&action=down&id=<?= $ttsp['ma_hh'] ?>"><i class="fas fa-caret-down"></i></a>
                                                <?php else : ?>
                                                    <a style="font-size:1.2rem" class="row text-decoration-none" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="<?= BASE_URL ?>/?controller=cart&action=delete-cart&id=<?= $ttsp['ma_hh'] ?>"><i class="fas fa-caret-down"></i></a>
                                                <?php endif; ?>
                                        </td>
                                        <td style="font-size: 0.9rem;" class="pt-4">
                                            <span class="font-weight-bold"><?= number_format($ttsp['don_gia'] * (1 - $ttsp['giam_gia'] * 0.01) * $SP['sl']) ?> VND</span>
                                        </td>
                                        <td class="pt-4">
                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="<?= BASE_URL ?>/?controller=cart&action=delete-cart&id=<?= $ttsp['ma_hh'] ?>">
                                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>

                                    <input type="hidden" value="<?= $tongtien += ($ttsp['don_gia'] * (1 - $ttsp['giam_gia'] * 0.01) * $SP['sl']); ?>">
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <?php echo $error  ?>
        <?php endif; ?>

        <?php if ($tongtien != 0) : ?>
            <div class="">
                <div class="cart__main--right mt-3">
                    <div class="cart__info">
                        <div class="my-1">
                            <span>
                                <?php if (isset($so_sp)) {
                                    echo $so_sp . ' Sản Phẩm';
                                } ?>
                            </span>
                        </div>
                        <div class="mb-2">
                            <span id="tongtien">
                                <?php
                                echo number_format($tongtien);
                                ?>
                                VND
                            </span>
                        </div>
                    </div>
                    <div class="cart__info cart__shipping">
                        <div>
                            <span>Phí giao hàng </span>
                        </div>
                        <div>
                            <span>50.000 VND</span>
                        </div>
                    </div>
                    <div class="cart__info pb-2">
                        <div>
                            <span>Tổng</span>
                        </div>
                        <div>
                            <span>
                                <?php
                                echo number_format($tongtien += 50000);
                                ?>
                                VND
                            </span>
                        </div>
                    </div>
                    <div class="cart__checkout">
                        <?php if (isset($_SESSION['ma_kh'])) : ?>
                            <a class="btn-dark p-3 " href="<?= BASE_URL ?>/?controller=cart&action=check-out">
                                <span>CHECK OUT </span>
                            </a>
                        <?php else : ?>
                            <a class="btn-dark p-3" href="<?= BASE_URL ?>/?controller=user&action=login">
                                <span>CHECK OUT </span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </section>
</body>

</html>