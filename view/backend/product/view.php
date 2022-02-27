<?php
$product = product_get_one(['ma_hh' => $_GET['id']]);
$slide_get_one = slide_get_one1(['ma_hh' => $_GET['id']])
?>
<div class="card-header">
    <h3 class="card-title">
        <i class="fas fa-info-circle"></i>
        Chi tiết Sản Phẩm
    </h3>
    <a class="btn btn-info btn-sm float-right" href="?module=backend&controller=product&action=edit&id=<?= $product['ma_hh'] ?>">
        <i class="fas fa-pencil-alt">
        </i>
        Edit
    </a>
</div>
<section class="content">
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
                                <p><span class="product-detail__note--bold">Bộ nhớ :</span> bạn đang xem bản 4GB/64GB</p>
                            </div>
                            <div class="product-detail__price">
                                <span class="product-detail__price--red">
                                    <?= number_format($product['don_gia']) ?>
                                </span>
                                <?php
                                if ($product['giam_gia'] !== '0') {
                                ?>
                                    <span class="product-detail__price--through">
                                        <div class="home__card--percent">
                                            <span>
                                                <?= number_format($product['don_gia'] - ($product['don_gia'] * $product['giam_gia'] / 100)) ?>
                                            </span>
                                        </div>
                                    </span>
                                <?php
                                }
                                ?>
                                <?php
                                if ($product['giam_gia'] !== '0') {
                                ?>
                                    <span class="product-detail__price--persent">
                                        <div class="home__card--percent">
                                            <span>
                                                <?= $product['giam_gia'] ?>
                                            </span>
                                        </div>
                                    </span>
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
                                <a href="#">
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
        <div class="product-detail__desc container">
            <div class="product-detail__desc--content">
                <p>
                    <?= $product['mo_ta'] ?>
                </p>
            </div>
        </div>
    </div>
</section>