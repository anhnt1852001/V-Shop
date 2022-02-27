

//test
<?php
require_once APP_PATH . '/model/product_model.php';
require_once APP_PATH . '/model/categories_model.php';
require_once APP_PATH . '/model/user_model.php';
require_once APP_PATH . '/model/thong_ke_model.php';
require_once APP_PATH . '/model/order_detail_model.php';
require_once APP_PATH . '/model/order_model.php';
// biến $action lấy ở file index.php ơ thư mục gốc website
//khi controller này nhúng vào file index bằng lệnh require thì sẽ sử dụng được biến action
switch ($action) {
    case 'add-cart':
        extract(add_cart());
        break;
    case 'show-cart':
        if (isset($_POST['btn-order'])) {
            extract(order());
        }
        extract(show_cart());
        break;
    case 'delete-cart':
        if (isset($_POST['btn-order'])) {
            extract(order());
        }
        extract(delete_cart());
        break;
    case 'up':
        if (isset($_POST['btn-order'])) {
            extract(order());
        }
        extract(up_cart());
        break;
    case 'down':
        if (isset($_POST['btn-order'])) {
            extract(order());
        }
        extract(down_cart());
        break;
    default: // giá trị mặc định sẽ gọi action trang chủ

        extract(Trangchu());
        break;
}
//viết hàm xử lí cho từng action
function order()
{

    $order = $_POST;
    echo "<pre>";
    print_r($_SESSION['cart']);
    echo "</pre>";

    // for($i=0;$i<count($order)-2;$i++){
    //     $data = implode(', ', array_column($order, ''.$i)); 
    //     echo $data.'<br>';

    // }
    // return pdo_execute($sql,$params);
    // extract($_POST);
    // $dataInsert = [
    //     'ma_hd'=>$ma_hd,
    //     'ngay_mua'=>$ngay_mua,
    //     'ngay_ship'=>$ngay_ship,
    //     'tinh_trang'=>$tinh_trang==1
    // ];
    // $last_id = order_add($dataInsert);
    // $msg = "THÊM MỚI THÀNH CÔNG, MÃ MẶT HÀNG :" . $last_id;
    // order_detail_add();
    die();


    return [
        'view_name' => 'cart/show-cart.php',
    ];
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

function add_cart1()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    // $_SESSION['cart'];
    if (empty($_GET['id'])) {
        // không có id sản phẩm thì chuyển thẳng về trang danh sách.
        header('Location:index.php');
    }

    $ma_hh = intval($_GET['id']); // lấy số nguyên thì biến idsp luôn là số, không sợ lỗi.


    if ($ma_hh <= 0) {
        // đầu vào không phải là số hoặc số âm thì không chấp nhận.
        header('Location:index.php');
    }

    //====== kiểm tra giỏ hàng: Giỏ hàng chưa hoạt động thì khai báo sẵn mảng
    if (!isset($_SESSION['cart']))
        $_SESSION['cart'] = [];

    if (!isset($_SESSION['cart'][$ma_hh])) { // chưa có sản phẩm trong giỏ hàng
        $_SESSION['cart'][$ma_hh] = 1;
    } else // sản phẩm này đã có rồi, cần tăng số lượng
        $_SESSION['cart'][$ma_hh]++;

    // xong việc cho vào giỏ hàng ==> chuyển trang.
    header('Location:?controller=cart&action=show-cart');
    // header("refresh:0");

    return [
        'view_name' => 'cart/show-cart.php'
    ];
}
function add_cart()
{
    $ma_hh = $_GET['id'];
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['cart'])) {
        $i = count($_SESSION['cart']);
    } else {
        $i = 0;
    }

    // $_SESSION['cart'][$i]['ma_hh'] = $ma_hh;    
    $_SESSION['cart'][$i]['ma_hh'] = $ma_hh;

    $_SESSION['cart'][$i]['sl'] = 1;

    // print_r($_SESSION['cart']);
    // die();


    // if (!isset($_SESSION['cart'][$i]['ma_hh'])) { // chưa có sản phẩm trong giỏ hàng
    //     $_SESSION['cart'][$i]['sl'] = 1;

    // } else{
    //     $_SESSION['cart'][$i]['sl']++;// sản phẩm này đã có rồi, cần tăng số lượng
    // } 
    //  print_r($_SESSION['cart']);
    //  die();
    // print_r($_SESSION['cart'][$i]['sl']);
    // die();
    header('Location:?controller=cart&action=show-cart');
    // header("refresh:0");
    return [
        'view_name' => 'cart/show-cart.php'
    ];
}

function show_cart()
{
    // session_destroy();
    // die();

    if (!isset($_SESSION)) {
        session_start();
    }
    // print_r($_SESSION['cart']);
    // die();
    // if (!empty($_SESSION['cart'])) {
        // $ma_hh = array_keys($_SESSION['cart']);
        // $ma_hh = implode(',', $ma_hh);
        // $product_cart = product_add_cart($ma_hh);
        // $so_sp = count(array_keys($_SESSION['cart']));
        return [
            'view_name' => 'cart/show-cart.php',
            // 'product_cart' => $product_cart,
            // 'so_sp' => @$so_sp,
        ];
    // } else {
    //     $error = "Chưa có sản phẩm nào trong giỏ !";
    //     return [
    //         'view_name' => 'cart/show-cart.php',
    //         'error' => @$error
    //     ];
    // }
}
function up_cart()
{
    $ma_hh = intval($_GET['id']);
    $_SESSION['cart'][$ma_hh]++;
    $ma_hh = array_keys($_SESSION['cart']);
    $ma_hh = implode(',', $ma_hh);
    $product_cart = product_add_cart($ma_hh);
    $so_sp = count(array_keys($_SESSION['cart']));
    return [
        'view_name' => 'cart/show-cart.php',
        'product_cart' => $product_cart,
        'so_sp' => @$so_sp,
    ];
}
function down_cart()
{
    $ma_hh = intval($_GET['id']);
    $ma_hh = $_SESSION['cart'][$ma_hh]--;
    $ma_hh = array_keys($_SESSION['cart']);
    $ma_hh = implode(',', $ma_hh);
    $product_cart = product_add_cart($ma_hh);
    $so_sp = count(array_keys($_SESSION['cart']));

    // if($ma_hh==0){
    //     echo '';
    //     header("location:". BASE_URL ."/?controller=cart&action=delete-cart&id=".$_GET['id']);
    // }

    return [
        'view_name' => 'cart/show-cart.php',
        'product_cart' => $product_cart,
        'so_sp' => @$so_sp,
    ];
}
function delete_cart()
{

    $ma_hh = $_GET['id'];
    // $_SESSION['cart'][$i]['ma_hh'] = $ma_hh;
    // print_r($_SESSION['cart'][0]['ma_hh']);
    // die();
    unset($_SESSION['cart'][$ma_hh]);

    if (!empty($_SESSION['cart'])) {
        $ma_hh = array_keys($_SESSION['cart']);
        $ma_hh = implode(',', $ma_hh);
        $product_cart = product_add_cart($ma_hh);
        $so_sp = count(array_keys($_SESSION['cart']));
        return [
            'view_name' => 'cart/show-cart.php',
            'product_cart' => $product_cart,
            'so_sp' => @$so_sp,
        ];
    } else {
        $error = "Chưa có sản phẩm nào trong giỏ !";
        return [
            'view_name' => 'cart/show-cart.php',
            'error' => @$error
        ];
    }
}
// function delete_all(){
//     if(isset($_POST['btn_delete_all'])){
//         session_destroy();
// 		header("refresh:0");
//     }
//     return[
//         'view_name'=>'cart/show-cart.php',
//     ];
// }


















