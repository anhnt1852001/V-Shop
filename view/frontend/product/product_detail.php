<?php
// echo "<pre>";
// print_r($product);
// echo "</pre>";
// die();
// $url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

?>
<div class="link">
    <div class="container">
        <div class="link__main">
            <span><a href="<?= BASE_URL ?>">Home </a></span>
            <span><a href="<?= BASE_URL ?>/?controller=product&action=products&ten_mh=<?= $product['ten_mh'] ?>"> <?= $product['ten_mh'] ?></a></span>
            <span> <?= $product['ten_hh'] ?></span>
        </div>
    </div>
</div>
<div class="product-detail container">
    <div class="product-detail__title">
        <h2 class="">
            <?= $product['ten_hh'] ?>
        </h2>
        <span>trả góp 0%</span>
    </div>
    <div class="product-detail__main ">
        <div class="row">
            <div class="product-detail__left col-4">
                <div class="product-detail__image">
                    <img class="img-fluid" src="<?= BASE_URL ?>/public/content/images/product/<?= $product['hinh'] ?>" alt="điện thoại iphhone 12">
                </div>
                <div class="product-detail__slide slick_slide">
                    <div class=" product-detail__slide--item">
                        <img src="<?= BASE_URL ?>/public/content/images/slides/<?= $slide_get_one['ten_slide1'] ?>" class="img-fluid" alt="slide <?= $product['ten_hh'] ?>">
                    </div>
                    <div class=" product-detail__slide--item">
                        <img src="<?= BASE_URL ?>/public/content/images/slides/<?= $slide_get_one['ten_slide2'] ?>" class="img-fluid" alt="slide <?= $product['ten_hh'] ?>">
                    </div>
                    <div class=" product-detail__slide--item">
                        <img src="<?= BASE_URL ?>/public/content/images/slides/<?= $slide_get_one['ten_slide3'] ?>" class="img-fluid" alt="slide <?= $product['ten_hh'] ?>">
                    </div>
                    <div class=" product-detail__slide--item">
                        <img src="<?= BASE_URL ?>/public/content/images/slides/<?= $slide_get_one['ten_slide4'] ?>" class="img-fluid" alt="slide <?= $product['ten_hh'] ?>">
                    </div>
                    <div class=" product-detail__slide--item">
                        <img src="<?= BASE_URL ?>/public/content/images/slides/<?= $slide_get_one['ten_slide5'] ?>" class="img-fluid" alt="slide <?= $product['ten_hh'] ?>">
                    </div>
                </div>
            </div>
            <div class="product-detail__right col-8">
                <div class="row">
                    <div class="col-6">
                        <div class="product-detail__note">
                            <p><span class="product-detail__note--bold">Bộ nhớ :</span> bạn đang xem bản <?= $product['ram'] ?>GB / <?= $product['storage'] ?> GB</p>
                        </div>
                        <div class="product-detail__price">
                            <span class="product-detail__price--red">
                                <?= number_format($product['don_gia']) ?>
                            </span>
                            <?php
                            if ($product['giam_gia'] !== '0') {
                            ?>
                                <div class="product-detail__price--through">
                                    <div class="home__card--percent">
                                        <span>
                                            <?= number_format($product['don_gia'] - ($product['don_gia'] * $product['giam_gia'] / 100)) ?>
                                        </span>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if ($product['giam_gia'] !== '0') {
                            ?>
                                <div class="product-detail__price--persent">
                                    <div class="home__card--percent">
                                        <span>
                                            <?= $product['giam_gia'] ?>
                                        </span>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="product-detail__version">
                            <div class="product-detail__version--item">
                                <div class="product-detail__version--memory">
                                    <span class="product-detail__version--ram">
                                        4GB
                                    </span>
                                    <span class="product-detail__main--version--rom">
                                        / 32GB
                                    </span>
                                </div>
                                <div class="product-detail__version--price">
                                    <span>
                                        25.000.000 vnd
                                    </span>
                                </div>
                            </div>
                            <div class="product-detail__version--item">
                                <div class="product-detail__version--memory">
                                    <span class="product-detail__version--ram">
                                        4GB
                                    </span>
                                    <span class="product-detail__main--version--rom">
                                        / 64GB
                                    </span>
                                </div>
                                <div class="product-detail__version--price">
                                    <span>
                                        28.000.000 vnd
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="product-detail__btn product-detail__btn--orange">

                            <a href="<?= BASE_URL ?>/?controller=cart&action=add-cart&id=<?= $product['ma_hh'] ?>">
                                <span>Mua hàng </span>
                                <p>Giao tận nơi hoặc tại cửa hàng</p>
                            </a>
                        </div>
                        <div class="product-detail__btn product-detail__btn--blue">
                            <a href="#">
                                <span>Trả góp lãi suất thấp </span>
                                <p>Tư vấn qua điện thoại</p>
                            </a>
                        </div>
                        <div class="product-detail__policy">
                            <div class="product-detail__btn--green">
                                <a href="#">
                                    <span>Khuyến mại </span>
                                </a>
                            </div>
                            <ul>
                                <li>Giảm 200.000vnd khi mua kèm tai nghe Aripods</li>
                                <li>Trả góp 0%</li>
                                <li>Trả góp lãi suất 0% với Home Credit trả trước 20%</li>
                                <li>Kỳ hạn 6 tháng</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6 product-detail__accessories">
                        <div class="product-detail__btn product-detail__btn--orange">
                            <span>Phụ Kiện</span>
                        </div>
                        <ul>
                            <li>
                                <span>Tình trạng</span>
                                <p>Nguyên hộp , đầy đủ phụ kiện</p>
                            </li>
                            <li>
                                <span>Hộp bao gồm</span>
                                <p>Máy , Sạc , Que lấy SIM , Sách hướng dẫn</p>
                            </li>
                            <li>
                                <span>Bảo hành</span>
                                <p>bảo hành 18 tháng tại trung tâm bảo hàng chính hãng 1 đổi 1 trong 30 ngày nếu lỗi do nhà sản xuât</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-9">
            <div class="product-detail__desc container">
                <div class="product-detail__desc--content">
                    <p>
                        <?php
                        echo $product['mo_ta'];
                        ?>
                    </p>
                </div>
                <div class="product-detail__desc--image">
                    <img height="300" class="" src="<?= BASE_URL ?>/public/content/images/product_banner/<?= $product['banner'] ?>" alt="">
                </div>
            </div>
            <div class="product-detail__suggest mt-3 px-1">
                <div class="product-detail__suggest--heading">
                    <span>Sản phẩm tương tự </span>
                </div>
                <div class="row mx-n1 bg-light">
                    <?php
                    foreach ($get_top4_by_brand_and_cate as $product) {
                    ?>
                        <div class="product-detail__suggest--card col-3 px-0">
                            <a href="<?= BASE_URL ?>/?controller=product&action=detail&id=<?= $product['ma_hh'] ?>">
                                <div class="product-detail__suggest--iamge">
                                    <img src="<?= BASE_URL ?>/public/content/images/product/<?= $product['hinh'] ?>" class="card-img-top" alt="...">
                                </div>

                                <div class="product-detail__suggest--text">
                                    <h2 class="card-title product-detail__suggest--title">
                                        <span>
                                            <a href="<?= BASE_URL ?>/?controller=product&action=detail&id=<?= $product['ma_hh'] ?>">
                                                <?= $product['ten_hh'] ?>
                                            </a>
                                        </span>
                                    </h2>
                                    <div class="product-detail__suggest--price">

                                        <span class="product-detail__suggest--price-static">
                                            <?= number_format($product['don_gia']) ?>
                                        </span>
                                        <?php
                                        if ($product['giam_gia'] !== '0') {
                                        ?>
                                            <div class="product-detail__suggest--price-sub">
                                                <span>
                                                    <?= number_format($product['don_gia'] - ($product['don_gia'] * $product['giam_gia'] / 100))  ?>
                                                </span>
                                                <span>
                                                    <?= $product['giam_gia'] ?>
                                                </span>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="product-detail__suggest--specifications">
                                        <span>
                                            RAM : <?= $product['ram'] ?>GB
                                        </span>
                                        <span>
                                            Bộ nhớ trong : <?= $product['storage'] ?>GB
                                        </span>
                                    </div>
                                    <div class="product-detail__suggest--star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    }

                    ?>
                </div>
            </div>
            <div class="product-detail__comment bg-light p-3 mt-4">
                <div class="product-detail__comment--heading">
                    <span>
                        Bình luận
                    </span>
                </div>
                <?php
                if (isset($_SESSION['ma_kh'])) {
                ?>
                    <div class="product-detail__comment--form">
                        <form action="" class="form-group" method="post">
                            <div class="row">
                                <div class="col-9">
                                    <input type="text" class="form-control" name="noi_dung">
                                </div>
                                <div class="col-3">
                                    <button name="btn_gui_bl" class="btn btn-primary">gửi bình luận </button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
                } else {
                ?>
                    <div class="row product-detail__comment--error">
                        <div class="col-8">
                            <span>Vui lòng đăng nhập để có thể bình luận</span>
                        </div>
                        <div class="col-4">
                            <span>
                                <a class="btn btn-sm btn-primary" href="<?= BASE_URL ?>/?controller=user&action=login">đăng nhập</a>
                            </span>
                        </div>
                    </div>
                <?php
                }
                ?>

                <div class="product-detail__comment--box">
                    <?php
                    // print_r($get_bl_by_id_hang_hoa);
                    foreach ($get_bl_by_id_hang_hoa as $bl) {
                    ?>
                        <div class="mt-2">
                            <div class="product-detail__comment--user">
                                <span> <?= $bl['ho_ten'] ?></span>
                            </div>
                            <div class="product-detail__comment--content">
                                <?= $bl['noi_dung'] ?>
                            </div>
                            <div class="product-detail__comment--date text-right">
                                <span>Đã bình luận vào</span>
                                <?= $bl['ngay_bl'] ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>