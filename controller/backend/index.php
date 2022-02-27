<?php
require_once APP_PATH.'/model/product_model.php';
require_once APP_PATH.'/model/user_model.php';
require_once APP_PATH.'/model/thong_ke_model.php';
require_once APP_PATH . '/model/order_model.php';
require_once APP_PATH . '/model/order_detail_model.php';
switch ($action) {
    case 'index':
        extract(index());
        break;
        case '404':
            extract(page404());
            break;
    default:
        extract(Index());
        break;
    }
    function page404(){
        // $msg;
        return[
            'view_name'=>'404.php',
            // 'msg'=>@$msg
        ];
    }
    function index()
    {
        $recent_user = recent_user();
        $count_user = count_user();
        $count_luot_xem = so_luot_xem();
        $count_giam_gia = count_giam_gia();
        $recent_product = recent_product();
        $count_product_day_arr = count_product_day_arr();
        $count_product_cate = thong_ke_hang_hoa();
        $detail_order=order_list_all();
        $sum_cart_by_day=sum_cart_by_day();
        $count_order=count_order();
        $count_order_complete=count_order_complete();
        $count_order_not_delivery=count_order_not_delivery();
        $count_order_delivered=count_order_delivered();
        $sum_sp_order_detail=sum_sp_order_detail();
        $count_product=count_product();
        return [
            'view_name' => 'index.php',
            'recent_user' => $recent_user,
            'count_user' => $count_user,
            'count_luot_xem' => $count_luot_xem,
            'count_giam_gia' => $count_giam_gia,
            'recent_product' => $recent_product,
            'count_product_day_arr' => $count_product_day_arr,
            'count_product_cate' =>  $count_product_cate,
            'detail_order'=>$detail_order,
            'sum_cart_by_day'=>$sum_cart_by_day,
            'count_order'=>$count_order,
            'count_order_complete'=>$count_order_complete,
            'count_order_not_delivery'=>$count_order_not_delivery,
            'count_order_delivered'=>$count_order_delivered,
            'sum_sp_order_detail'=>$sum_sp_order_detail,
            'count_product'=>$count_product
        ];
    }
?>