<header class="header">
    <!-- ============end header about======= -->
    <div class="container">
        <div class="d-flext justify-content-between header__top">
            <div class="col-1 header__top-logo">
                <a href="<?= BASE_URL ?>/">
                    <img src="<?= BASE_URL ?>/public/content/images/logo/logo_v-shop.jpg" alt="img-fluid">
                </a>
            </div>
            <div class="position-relative">
                <div class=" header__top-searchbox">
                    <form action="<?= BASE_URL ?>/?controller=product&action=products" method="POST">
                        <input type="text" name="search" id="search" class="search" placeholder="Nhập sản phẩn tìm kiếm....">
                        <button name="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="position-absolute z__index">
                    <ul class="list-group" id="show-list">

                    </ul>
                </div>
            </div>
            <div class="header__top--item">
                <div class="header__top--icon mr-2">
                    <span>
                        <i class="fas fa-phone-square-alt"></i>
                    </span>
                </div>
                <div class="header__top--text">
                    <span>Hot line : </span>
                    <p class="mt-1">0964911301</p>
                </div>
            </div>
            <div class="header__top--item">
                <div class="mr-2">
                    <?php
                    if (isset($_SESSION['ma_kh'])) {
                    ?>
                        <a href="<?= BASE_URL ?>/?controller=user&action=update&id=<?= $_SESSION['ma_kh']['ma_kh'] ?>">
                            <img class="rounded-circle" width="40" height="40" src="<?= BASE_URL ?>/public/content/images/user/<?= $_SESSION['ma_kh']['hinh'] ?>" alt="">
                        </a>
                    <?php
                    } else {
                    ?>
                        <img class="rounded-circle" width="40" height="40" src="<?= BASE_URL ?>/public/content/images/user/user.png" alt="">
                    <?php
                    }
                    ?>
                </div>
                <div class="header__top--text">
                    <?php
                    if (isset($_SESSION['ma_kh'])) {
                    ?>
                        <a class="d-block" href="<?= BASE_URL ?>/?controller=user&action=logout">Đăng xuất</a>
                        <?php
                        if ($_SESSION['ma_kh']['vai_tro'] == 1) {
                        ?>
                            <a href="<?= BASE_URL ?>/?module=backend">Quản trị</a>
                        <?php
                        }
                        ?>
                    <?php
                    } else {
                    ?>
                        <div>
                            <a class="d-block" href="<?= BASE_URL ?>/?controller=user&action=login">Đăng nhập</a>
                            <a href="<?= BASE_URL ?>/?controller=user&action=register">Đăng ký</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="header__top--item">
                <div class="header__top--icon">
                    <a href="<?= BASE_URL ?>/?controller=cart&action=show-cart">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="badge badge-danger navbar-badge">
                            <?php if (isset($_SESSION['cart'])) : ?>
                                <?php echo count($_SESSION['cart']) ?>
                            <?php else : ?>
                                <?php echo '0' ?>
                            <?php endif; ?>
                        </span>
                    </a>
                </div>
                <div class="header__top--text">
                    <a href="<?= BASE_URL ?>/?controller=cart&action=show-cart">
                        <span>Giỏ hàng</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- =======end header top====== -->
    <div class="header__navbar">
        <div class="row">
            <nav class="container navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/">Trang chủ<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/?controller=product&action=products&ten_mh=laptop">laptop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/?controller=product&action=products&ten_mh=điện thoại">điện thoại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/?controller=product&action=products&ten_mh=phụ kiện">phụ kiện</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/?action=about-us">Về chúng tôi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/?action=about-us">liên hệ</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- =======end header======= -->