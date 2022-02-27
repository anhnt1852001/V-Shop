<?php
require_once APP_PATH . '/model/product_model.php';
require_once APP_PATH . '/model/order_model.php';
require_once APP_PATH . '/model/order_detail_model.php';
require_once APP_PATH . '/model/categories_model.php';
require_once APP_PATH . '/model/user_model.php';
require_once APP_PATH . '/model/thong_ke_model.php';
require_once APP_PATH . '/public/sendmail-sendgrid/vendor/autoload.php';
// biến $action lấy ở file index.php ơ thư mục gốc website
//khi controller này nhúng vào file index bằng lệnh require thì sẽ sử dụng được biến action
switch ($action) {
    case 'add-cart':
        extract(add_cart());
        break;
    case 'show-cart':
        extract(show_cart());
        break;
    case 'delete-cart':
        extract(delete_cart());
        break;
    case 'up':
        extract(up_cart());
        break;
    case 'down':
        extract(down_cart());
        break;
    case 'check-out':
        if (isset($_POST['send_cart'])) {
            extract(send_cart());
        }
        extract(check_out());
        break;
    default: // giá trị mặc định sẽ gọi action trang chủ
        extract(Trangchu());
        break;
}
//viết hàm xử lí cho từng action
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

function add_cart()
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

    if (!isset($_SESSION['cart'])) {
        $i = 0;
        $_SESSION['cart'][$i]['ma_hh'] = $ma_hh;
        $_SESSION['cart'][$i]['sl'] = 1;
    } else {
        $i = count($_SESSION['cart']);
        // nếu có session cart rồi

        foreach ($_SESSION['cart'] as $key => $value) {
            // $ttsp = infoSP($value['ma_hh']);
            //    print_r($value);
            if ($value['ma_hh'] === $ma_hh) {
                $_SESSION['cart'][$key]['sl']++;
                break;
            } else {
                $_SESSION['cart'][$i]['ma_hh'] = $ma_hh;
                $_SESSION['cart'][$i]['sl'] = 1;
                break;
            }
        }
    }
    // xong việc cho vào giỏ hàng ==> chuyển trang.
    header('Location:?controller=cart&action=show-cart');
    return [
        'view_name' => 'cart/show-cart.php',
    ];
}

function show_cart()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!empty($_SESSION['cart'])) {
        return [
            'view_name' => 'cart/show-cart.php',
        ];
    } else {
        $error = "<div class='text-center p-5 mt-4 bg-light shadow'> 
                    <p class='font-weight-bold'>Chưa có sản phẩm nào trong giỏ !</p>
                    <p class=' mt-3'><a class='text-primary' href='" . BASE_URL . "?controller=product&action=products'>Chọn thêm sản phẩm</a></p>
                </div>";
        return [
            'view_name' => 'cart/show-cart.php',
            'error' => @$error
        ];
    }
}
function up_cart()
{
    $ma_hh = intval($_GET['id']);
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['ma_hh'] === $ma_hh) {
            $_SESSION['cart'][$key]['sl']++;
            break;
        }
    }
    return [
        'view_name' => 'cart/show-cart.php',
    ];
}
function down_cart()
{
    $ma_hh = intval($_GET['id']);
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['ma_hh'] === $ma_hh) {
            $_SESSION['cart'][$key]['sl']--;
            break;
        }
    }
    return [
        'view_name' => 'cart/show-cart.php',
    ];
}
function delete_cart()
{
    // print_r($_SESSION['cart']);
    $ma_hh = $_GET['id'];
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['ma_hh'] == $ma_hh) {
            unset($_SESSION['cart'][$key]);
        }
    }
    if (!empty($_SESSION['cart'])) {
        return [
            'view_name' => 'cart/show-cart.php',
        ];
    } else {
        session_destroy();
        $error = "Chưa có sản phẩm nào trong giỏ !";
        return [
            'view_name' => 'cart/show-cart.php',
            'error' => @$error
        ];
    }
}
function check_out()
{
    return [
        'view_name' => 'cart/send_cart.php'
    ];
}
function send_cart()
{
    $err = ['nguoi_nhan' => '', 'sdt' => '', 'dia_chi' => ''];
    if (isset($_POST['send_cart'])) {
        $emailto = $_SESSION['ma_kh']['email'];
        $nguoi_nhan = $_POST['nguoi_nhan'];
        $sdt = $_POST['sdt'];
        $dia_chi = $_POST['dia_chi'];
        $trang_thai = $_POST['trang_thai'];
        $nguoi_lap_don = $_POST['nguoi_lap_don'];
        $ngay_lap_don = date('Y-m-d');
        $ma_hd = $_POST['ma_hd'];
        $tong_tien = $_POST['tong_tien'];
        $validate_hoten = '/^[a-zA-ZàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD ]{10,50}$/';
        $validate_phone = '/((09|03|07|08|05)+([0-9]{8})\b)/';
        //validate số điện thoại
        if (!preg_match($validate_phone, $sdt)) {
            $err['sdt'] = "<small style='font-size:0.8rem' class='text-danger'>*Số  điện thoại sai định dạng hoặc không được để trống !</small>";
        }
        //validate tên người nhận
        if (!preg_match($validate_hoten, $nguoi_nhan)) {
            $err['nguoi_nhan'] = "<small style='font-size:0.8rem' class='text-danger'>*Họ tên người nhận phải đúng định dạng và tối thiểu 10 ký tự !</small>";
        }
        if (empty($dia_chi)) {
            $err['dia_chi'] = "<small style='font-size:0.8rem' class='text-danger'>*Địa chỉ không được để trống !</small>";
        }

        //nếu k có lỗi thì ghi csdl
        if (!array_filter($err)) {
            // tạo mảng tham số để lưu csdl, key của mảng là tên cột trong csdl
            $dataInsert = [
                'nguoi_nhan' => $nguoi_nhan,
                'sdt' => $sdt,
                'dia_chi' => $dia_chi,
                'trang_thai' => $trang_thai,
                'nguoi_lap_don' => $nguoi_lap_don,
                'ngay_lap_don' => $ngay_lap_don,
                'ma_hd' => $ma_hd,
                'tong_tien' => $tong_tien
            ];
            $last_id = order_add($dataInsert);
            if (!isset($_SESSION['cart'])) {
                $c = "<div class='text-center p-5 mt-4 bg-light shadow'> 
                    <p class='font-weight-bold'>Vui lòng chọn sản phẩm để thanh toán</p>
                    <p class=' mt-3'><a class='text-primary' href='" . BASE_URL . "?controller=product&action=products'>Chọn thêm sản phẩm</a></p>
                </div>";
            } else {
                foreach ($_SESSION['cart'] as $key => $value) {
                    $ma_hh = $value['ma_hh'];
                    $so_luong = $value['sl'];
                    $don_gia = $_POST['don_gia'];
                    $dataInsert2 = [
                        'ma_hd' => $last_id,
                        'ma_hh' => $ma_hh,
                        'so_luong' => $so_luong,
                        'don_gia' => $don_gia
                    ];
                    order_detail_add($dataInsert2);
                }
                $c = "<div class='text-center p-5 mt-4 bg-light shadow'> 
                    <p class='font-weight-bold'> Đơn Hàng Đã Đặt Hàng Và Đang Chờ Xác Nhận</p>
                    <p class='mt-3'><a class='text-primary' href='" . BASE_URL . "?controller=product&action=products'>Chọn thêm sản phẩm</a></p>
                </div>";
            }
            //gửi mail
            $SENDGRID_API_KEY = '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';
            // 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
            // SG._cdWp-SHTmOwow07rID-fg.QUbWdwHVanGCNZGRqrBDqDhpfjQyhqFDsQTHN0j01_Qg
            $email = new \SendGrid\Mail\Mail();
            ///------- bạn chỉnh sửa các thông tin dưới đây cho phù hợp với mục đích cá nhân
            // Thông tin người gửi
            $email->setFrom("huynqph10119@fpt.edu.vn", "V-SHOP");
            // $email->setFrom($emailto, $name);
            // Tiêu đề thư
            $email->setSubject("Order confirmation");
            // Thông tin người nhận
            $email->addTo($emailto, $nguoi_nhan);
            // $email->addTo("huynqph10119@fpt.edu.vn", "Huy Nè");
            // Soạn nội dung cho thư
            // $email->addContent("text/plain", "Nội dung liên hệ:" . $message);
            // $don_hang_gui_mail=order_select_by_order_detail(['ma_hd'=>$last_id]);
            $email->addContent(
                "text/html",
                "
                <h3>From:V-SHOP</h3>
                <h4>Dear:$nguoi_nhan</h4>
                <p>Cảm ơn bạn mua hàng từ v-shop<br>Đơn hàng sẽ được xác nhận trong thời gian sớm nhất!<br></p>
                "
            );

            // tiến hành gửi thư
            $sendgrid = new \SendGrid($SENDGRID_API_KEY);
            if ($sendgrid->send($email)) {
                $result = "GỬI MAIL THÀNH CÔNG!";
            }
            unset($_SESSION['cart']);
        }

        return [
            'view_name' => 'cart/send_cart.php',
            'c' => @$c,
            'err' => @$err
        ];
    }
}
