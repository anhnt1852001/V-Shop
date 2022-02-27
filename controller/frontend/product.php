<?php
require_once APP_PATH . '/model/product_model.php';
require_once APP_PATH . '/model/comment_model.php';
require_once APP_PATH . '/model/categories_model.php';
require_once APP_PATH . '/model/trademark_model.php';
require_once APP_PATH . '/model/slide_model.php';
require_once APP_PATH . '/library/functions.php';
switch ($action) {
    case 'detail':
        extract(ProductDetail());
        break;
    case 'products':
        extract(Products());
        break;
    default;
        extract(TrangChu());
        break;
}
function TrangChu()
{
    $cate = categories_list_all();
    $list_laptop = product_list_top10('laptop');
    $list_phone = product_list_top10('Điện thoại');
    $list_accessories = product_list_top10('Phụ kiện');
    return [
        'view_name' => 'index/trang-chu.php',
        'list_categories' => $cate,
        'list_laptop' => $list_laptop,
        'list_phone' => $list_phone,
        'list_accessories' => $list_accessories
    ];
}
function ProductDetail()
{
    if (isset($_POST['btn_gui_bl']) && !empty($_POST['noi_dung'])) {
        $ma_kh = $_SESSION['ma_kh']['ma_kh'];
        $ngay_bl = date_format(date_create(), 'Y-m-d');
        $ma_hh = $_GET['id'];
        $noi_dung = $_POST['noi_dung'];
        comment_add(['noi_dung' => $noi_dung, 'ngay_bl' => $ngay_bl, 'ma_hh' => $ma_hh, 'ma_kh' => $ma_kh]);
    }
    sp_tang_so_luot_xem([':ma_hh' => $_GET['id']]);
    $product = product_join_get_one(['ma_hh' => $_GET['id']]);
    $ma_hh = $product['ma_hh'];
    $get_bl_by_id_hang_hoa = get_bl_by_id_hang_hoa($ma_hh);
    $get_top4_by_brand_and_cate =  get_top4_by_brand_and_cate($product['ten_th'], $product['ten_mh']);
    $slide_get_one = slide_get_one_by_ma_hh(['ma_hh' => $_GET['id']]);
    return [
        'view_name' => 'product/product_detail.php',
        'product' => $product,
        'slide_get_one' => $slide_get_one,
        'get_top4_by_brand_and_cate' => $get_top4_by_brand_and_cate,
        'get_bl_by_id_hang_hoa' => $get_bl_by_id_hang_hoa
    ];
}

function products()
{
    if (isset($_POST['submit']) && isset($_POST['search'])) {
        $search = $_POST['search'];
        $get_brand_product_by_categories = get_all_thuong_hieu();
        $get_ram_product_by_categories = get_ramAndStorage_product('ram');
        $get_storage_product_by_categories = get_ramAndStorage_product('storage');
    } else if (isset($_GET['ten_mh'])) {
        $get_brand_product_by_categories = get_brand_product_by_categories($_GET['ten_mh']);
        $get_ram_product_by_categories = get_ramAndStorage_product_by_categories($_GET['ten_mh'], 'ram');
        $get_storage_product_by_categories = get_ramAndStorage_product_by_categories($_GET['ten_mh'], 'storage');
        $search = '';
    }else{
        $get_brand_product_by_categories = get_all_thuong_hieu();
        $get_ram_product_by_categories = get_ramAndStorage_product('ram');
        $get_storage_product_by_categories = get_ramAndStorage_product('storage');
        $search = '';
    }

    return [
        'view_name' => 'product/products.php',
        'get_brand_product_by_categories' => $get_brand_product_by_categories,
        'get_ram_product_by_categories' => $get_ram_product_by_categories,
        'get_storage_product_by_categories' => $get_storage_product_by_categories,
        'search' => $search,
        // 'p' => $p
    ];
}
