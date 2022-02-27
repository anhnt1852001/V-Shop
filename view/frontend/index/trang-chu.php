<?php
// echo "<pre>";
// print_r($list_laptop);
// echo '</pre>';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
</head>

<body>
    <div class="home mt-3 ">
        <div class="row mx-n1 home__categories wow fadeIn">
            <!-- categories -->
            <div class="col-xl-3 px-1 d-none">
                <ul class="list-group">
                    <?php
                    foreach ($list_categories as $cate) {
                        echo '<li><a class="list-group-item" href="'.BASE_URL.'/?controller=product&action=products&ten_mh='. $cate['ten_mh'].'">' . $cate['ten_mh'] . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <!-- =========end categories======= -->

            <div class="col-12">
                <div class="row">
                    <!-- carousel -->
                    <div class="col-xl-8 px-1">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="<?= BASE_URL ?>/public/content/images/banner/banner_lon1.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?= BASE_URL ?>/public/content/images/banner/banner_lon2.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?= BASE_URL ?>/public/content/images/banner/banner_lon3.jpg" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <!-- end carousel -->

                    <!-- sub banner -->
                    <div class="col-xl-4 px-1">
                        <div class="">
                            <div class="">
                                <img src="<?= BASE_URL ?>/public/content/images/sub_banner/banner_nho5.png" alt="banner" class="img-fluid">
                            </div>
                            <div class="">
                                <img src="<?= BASE_URL ?>/public/content/images/sub_banner/banner_nho5.png" alt="banner" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <!-- end sub banner -->
                </div>
                <!-- banner -->
                <div class="home__banner mt-3 wow fadeIn d-none">
                    <div class="row mx-n1">
                        <div class="col-xl-4 px-1">
                            <img src="<?= BASE_URL ?>/public/content/images/sub_banner/banner_nho5.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-xl-4 px-1">
                            <img src="<?= BASE_URL ?>/public/content/images/sub_banner/banner_nho4.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-xl-4 px-1">
                            <img src="<?= BASE_URL ?>/public/content/images/sub_banner/banner_nho6.png" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
                <!-- =========end banner======= -->
            </div>
        </div>

        <section class="home__brand">
            <ul>
                <li class="home__brand--item">
                    <a href="#">
                        <img src="<?= BASE_URL ?>/public/content/images/logo/apple.png" class="img-fluid" alt="logo">
                    </a>
                </li>
                <li class=" home__brand--item">
                    <a href="#">
                        <img src="<?= BASE_URL ?>/public/content/images/logo/samsung.png" class="img-fluid" alt="logo">
                    </a>
                </li>
                <li class=" home__brand--item">
                    <a href="#">
                        <img src="<?= BASE_URL ?>/public/content/images/logo/huawei.png" class="img-fluid" alt="logo">
                    </a>
                </li>
                <li class="home__brand--item">
                    <a href="#">
                        <img src=" <?= BASE_URL ?>/public/content/images/logo/xiaomi.png" class="img-fluid" alt="logo">
                    </a>
                </li>
            </ul>
        </section>
        <div class="home__products mt-3 wow fadeIn">
            <!-- laptop -->
            <section class="mt-3">
                <div class="home__product--heading">
                    <h2>laptop</h2>
                </div>
                <div class="home__product--main slick">
                    <?php
                    foreach ($list_laptop as $product) {
                    ?>
                        <div class=" home__card">
                            <a href="<?= BASE_URL ?>/?controller=product&action=detail&id=<?= $product['ma_hh'] ?>">
                                <div class="card">
                                    <img src="<?= BASE_URL ?>/public/content/images/product/<?= $product['hinh'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body home__card--body">
                                        <h2 class="card-title home__card--title">
                                            <span>
                                                <a href="<?= BASE_URL ?>/?controller=product&action=detail&id=<?= $product['ma_hh'] ?>">
                                                    <?= $product['ten_hh'] ?>
                                                </a>
                                            </span>
                                        </h2>
                                        <div class="home__card--price">
                                            <?php
                                            if ($product['giam_gia'] !== '0') {
                                            ?>
                                                <div class="home__card--percent">
                                                    <span>
                                                        <?= $product['giam_gia'] ?>
                                                    </span>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <p class="card-text">
                                                <span class="home__price--static">
                                                    <?= number_format($product['don_gia']) ?>
                                                </span>
                                                <?php
                                                if ($product['giam_gia'] !== '0') {
                                                ?>
                                                    <span class="home__price--sub">
                                                        <?= number_format($product['don_gia'] - ($product['don_gia'] * $product['giam_gia'] / 100))  ?>
                                                    </span>
                                                <?php
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <div class="home__specifications">
                                            <span class="home__specifications--ram">
                                                RAM : <?= $product['ram'] ?>GB
                                            </span>
                                            <span class="home__specifications--storage">
                                                Bộ nhớ trong : <?= $product['storage'] ?>GB
                                            </span>
                                        </div>
                                        <div class="home__card--star">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </section>
            <!-- end laptop -->

            <!-- dien thoai -->
            <section class="mt-3">
                <div class="home__product--heading">
                    <h2>điện thoại</h2>
                </div>
                <div class="home__product--main slick">
                    <?php
                    foreach ($list_phone as $product) {
                    ?>
                        <div class=" home__card">
                            <a href="<?= BASE_URL ?>/?controller=product&action=detail&id=<?= $product['ma_hh'] ?>">
                                <div class="card">
                                    <img src="<?= BASE_URL ?>/public/content/images/product/<?= $product['hinh'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body home__card--body">
                                        <h2 class="card-title home__card--title">
                                            <span>
                                                <a href="<?= BASE_URL ?>/?controller=product&action=detail&id=<?= $product['ma_hh'] ?>">
                                                    <?= $product['ten_hh'] ?>
                                                </a>
                                            </span>
                                        </h2>
                                        <div class="home__card--price">
                                            <?php
                                            if ($product['giam_gia'] !== '0') {
                                            ?>
                                                <div class="home__card--percent">
                                                    <span>
                                                        <?= $product['giam_gia'] ?>
                                                    </span>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <p class="card-text">
                                                <span class="home__price--static">
                                                    <?= number_format($product['don_gia']) ?>
                                                </span>
                                                <?php
                                                if ($product['giam_gia'] !== '0') {
                                                ?>
                                                    <span class="home__price--sub">
                                                        <?= number_format($product['don_gia'] - ($product['don_gia'] * $product['giam_gia'] / 100))  ?>
                                                    </span>
                                                <?php
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <div class="home__specifications">
                                            <span class="home__specifications--ram">
                                                RAM : <?= $product['ram'] ?>GB
                                            </span>
                                            <span class="home__specifications--storage">
                                                Bộ nhớ trong : <?= $product['storage'] ?>GB
                                            </span>
                                        </div>
                                        <div class="home__card--star">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </section>
            <!-- end dien thoai -->

            <!-- phu kien -->
            <section class="mt-3">
                <div class="home__product--heading">
                    <h2>phụ kiện</h2>
                </div>
                <div class="home__product--main slick row">
                    <?php
                    foreach ($list_accessories as $product) {
                    ?>
                        <div class=" home__card col-3">
                            <a href="<?= BASE_URL ?>/?controller=product&action=detail&id=<?= $product['ma_hh'] ?>">
                                <div class="card">
                                    <img src="<?= BASE_URL ?>/public/content/images/product/<?= $product['hinh'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body home__card--body">
                                        <h2 class="card-title home__card--title">
                                            <span>
                                                <a href="<?= BASE_URL ?>/?controller=product&action=detail&id=<?= $product['ma_hh'] ?>">
                                                    <?= $product['ten_hh'] ?>
                                                </a>
                                            </span>
                                        </h2>
                                        <div class="home__card--price">
                                            <?php
                                            if ($product['giam_gia'] !== '0') {
                                            ?>
                                                <div class="home__card--percent">
                                                    <span>
                                                        <?= $product['giam_gia'] ?>
                                                    </span>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <p class="card-text">
                                                <span class="home__price--static">
                                                    <?= number_format($product['don_gia']) ?>
                                                </span>
                                                <?php
                                                if ($product['giam_gia'] !== '0') {
                                                ?>
                                                    <span class="home__price--sub">
                                                        <?= number_format($product['don_gia'] - ($product['don_gia'] * $product['giam_gia'] / 100))  ?>
                                                    </span>
                                                <?php
                                                }
                                                ?>
                                            </p>
                                        </div>
                                       
                                        <div class="home__card--star">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </section>
            <!-- end phu kien -->
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {

        $('.responsive').slick({
            dots: true,
            infinite: false,
            arrows: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
</script>

</html>