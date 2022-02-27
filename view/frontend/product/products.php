<?php
// echo "<pre>";
// print_r($search);
// echo "</pre>";
// die();
// $url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

?>

<title>Sản phẩm</title>
<div class="link">
    <div class="container">
        <div class="link__main">
            <span><a href="<?= BASE_URL ?>">Home </a></span>
            <?php
            if (isset($_GET['ten_mh'])) {
            ?>
                <span><a href="<?= BASE_URL ?>?controller=product&action=products&ten_mh=<?= $_GET['ten_mh'] ?>"> <?= $_GET['ten_mh'] ?></a></span>
            <?php
            } else {
            ?>
                <span>Sản phẩm</span>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<div class="products mt-1 wow bounceIn">
    <div class="container">
        <div class="products__banner row mx-n1">
            <div class="products__banner--small col-6 px-1">
                <a href="<?= BASE_URL ?>/?controller=product&action=detail&id=13">
                    <img src="<?= BASE_URL ?>/public/content/images/banner/banner_vip.jpg" alt="banner" class="img-fluid">
                </a>
            </div>
            <div class="products__banner--small col-6 px-1">
                <a href="<?= BASE_URL ?>/?controller=product&action=detail&id=13">
                    <img src="<?= BASE_URL ?>/public/content/images/banner/banner_vip.jpg" alt="banner" class="img-fluid">
                </a>
            </div>
        </div>
        <div class="row mx-n1">
            <div class="col-3 px-1">
                <div class="bg-light products__filter mt-2">
                    <div class="products__filter--item products__filter--price">
                        <p>Khoảng giá</p>
                        <div class="list-group">
                            <input type="hidden" name="" value="0" id="hidden_minimun_price">
                            <input type="hidden" name="" value="100000000" id="hidden_maximun_price">
                            <p class="products__filter--desc" id="price_show">từ 500 nghìn đến 100 triệu</p>
                            <div class="products__filter--range">
                                <div id="price_range"></div>
                            </div>
                        </div>
                    </div>
                    <div class="products__filter--item products__filter--brand">
                        <p>thương hiệu</p>
                        <div class="list-group">
                            <?php
                            foreach ($get_brand_product_by_categories as $key => $value) {
                            ?>
                                <div class="list-group-item">
                                    <input type="checkbox" class="common_selector brand" value="<?= $value['ten_th'] ?>"> <?= $value['ten_th'] ?>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="products__filter--item products__filter--ram ">
                        <p>RAM</p>
                        <?php
                        foreach ($get_ram_product_by_categories as $key => $value) {
                            if ($value['ram'] === '0') {
                                $class_name_ram = 'd-none';
                            } else {
                                $class_name_ram = '';
                            }
                        ?>
                            <div class="list-group ">
                                <div class="list-group-item <?= $class_name_ram ?>">
                                    <input type="checkbox" class="common_selector ram" value="<?= $value['ram'] ?>"> <?= $value['ram'] ?>GB
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="products__filter--item products__filter--storage">
                        <p>bộ nhớ trong</p>
                        <?php
                        foreach ($get_storage_product_by_categories as $key => $value) {
                            if ($value['storage'] !== '0') {
                                $class_name_storage = "";
                            } else {
                                $class_name_storage = "d-none";
                            }
                        ?>
                            <div class="list-group">
                                <div class="list-group-item <?= $class_name_storage ?>">
                                    <input type="checkbox" class="common_selector storage" value="<?= $value['storage'] ?>"> <?= $value['storage'] ?>GB
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                </div>
            </div>
            <div class="products__items col-9 px-1">
                <div class="row filter_data mx-n1">

                </div>
            </div>
        </div>
        <div class="d-none">
            <ul class=" pagination text-center">
                <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?controller=product&action=products&ten_mh=<?= $_GET['ten_mh'] ?>&page_no=1">|&lt;</a></li>
                <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?controller=product&action=products&ten_mh=<?= $_GET['ten_mh'] ?>&page_no=<?= $_SESSION['prev_page'] ?>">
                        <<</a> </li> <?php for ($i = 1; $i <= $_SESSION['total_page']; $i++)
                                            echo '<li class="page-item"><a class="page-link"  href="' . BASE_URL . '/?controller=product&action=products&ten_mh=' . $_GET['ten_mh'] . '&page_no=' . $i . '">' . $i . '</a></li>  '
                                        ?> <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?controller=product&action=products&ten_mh=<?= $_GET['ten_mh'] ?>&page_no=<?= $_SESSION['next_page'] ?>">>></a></li>
                <li class="page-item"><a class="page-link" href="<?= BASE_URL ?>/?controller=product&action=products&ten_mh=<?= $_GET['ten_mh'] ?>&page_no=<?= $_SESSION['total_page'] ?>">>|</a></li>
            </ul>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        filter_data();

        function filter_data() {
            var action = 'get_data';
            var minimum_price = $('#hidden_minimun_price').val();
            var maximum_price = $('#hidden_maximun_price').val();
            var brand = get_filter('brand');
            var ram = get_filter('ram');
            var storage = get_filter('storage');
            $.ajax({
                url: "./controller/frontend/get_data.php?ten_mh=<?= isset($_GET['ten_mh']) ? $_GET['ten_mh'] : '' ?>&search=<?= isset($search) ? $search : '' ?>",
                method: "POST",
                data: {
                    action: action,
                    minimum_price: minimum_price,
                    maximum_price: maximum_price,
                    brand: brand,
                    ram: ram,
                    storage: storage
                },
                success: function(data) {
                    $('.filter_data').html(data);
                }
            });
        }

        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function() {
                filter.push($(this).val());
            });
            return filter;
        }
        $('.common_selector').click(function() {
            filter_data();
        });
        $("#price_range").slider({
            range: true,
            min: 500000,
            max: 100000000,
            values: [500000, 1000000000],
            step: 500000,
            stop: function(event, ui) {
                $('#price_show').html('từ : ' + ui.values[0] + ' đến ' + ui.values[1]);
                $('#hidden_minimun_price').val(ui.values[0]);
                $('#hidden_maximun_price').val(ui.values[1]);
                filter_data();
            }
        })
    });
</script>