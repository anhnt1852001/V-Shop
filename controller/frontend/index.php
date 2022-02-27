<?php

require_once APP_PATH . '/library/functions.php';

//huy
require_once APP_PATH.'/model/categories_model.php';
require_once APP_PATH.'/model/product_model.php';
require_once APP_PATH.'/model/user_model.php';
require_once APP_PATH.'/model/thong_ke_model.php';
switch ($action) {
    case 'lien-he':
        extract(LienHe());
        break;
    default:
        extract(TrangChu());
        break;
}

function TrangChu()
{
    $cate = categories_list_all();
    $list_laptop = product_list_top10('laptop');
    $list_phone= product_list_top10('Điện thoại');
    $list_accessories = product_list_top10('Phụ kiện');
    return [
        'view_name' => 'index/trang-chu.php',
        'list_categories' => $cate,
        'list_laptop' => $list_laptop,
        'list_phone' => $list_phone,
        'list_accessories' => $list_accessories
    ];
}

function LienHe()
{
    $msg = 'dday la thong bao viet o lien he ';
    return [
        'view_name' => 'index/trang-chu.php',
        'msg' => $msg
    ];
}
