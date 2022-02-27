<?php
require_once APP_PATH . '/model/product_model.php';
require_once APP_PATH . '/model/order_model.php';
require_once APP_PATH . '/model/order_detail_model.php';
require_once APP_PATH . '/model/thong_ke_model.php';
require_once APP_PATH . '/library/functions.php';
switch ($action) {
    case 'detail':
        extract(detail_order());
        break;
    default:
        extract(Index());
        break;
}


function detail_order()
{
    $detail_order = order_select_by_order_detail(['ma_hd' => $_GET['id']]);
    $product_all = product_list_all();
    return [
        'view_name' => 'order/detail.php',
        'detail_order' => $detail_order,
        'product_all' => $product_all
    ];
}

function Index()
{
    $list_order = order_select_page([]);
    return [
        'view_name' => 'order/list.php',
        'list_order' => $list_order,
    ];
}

