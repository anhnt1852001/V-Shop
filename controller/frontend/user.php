<?php
require_once APP_PATH . '/model/user_model.php';
require_once APP_PATH . '/library/functions.php';

if (isset($_SERVER['HTTP_REFERER'])) {
    if (!strpos($_SERVER['HTTP_REFERER'], 'controller=user')) {
        $_SESSION['tk_http_referer'] = $_SERVER['HTTP_REFERER'];
    }
}

switch ($action) {
    case 'login':
        extract(DangNhap());
        break;
    case 'logout':
        extract(DangXuat());
        break;
    case 'forgot':
        extract(QuenMatKhau());
        break;
    case 'register':
        extract(add_user());
        break;
    case 'update':
        extract(edit_user());
        break;
    default:
        header("location:?");
        break;
}

//viết hàm xử lí

function DangNhap()
{

    $msg = "Hàm đăng nhập";
    if (isset($_POST['btn_login'])) {
        extract($_REQUEST);
        //lấy dữ liệu người dùng bấm nút gửi dạng post
        $msg = '<br> Xin chào: ' . $ma_kh;
        // $pass=$_POST['mat_khau'];
        //lấy thông tin tài khoản qua username, không truyền pass vào đây
        $userInfo = user_get_one(['ma_kh' => $_POST['ma_kh']]);
        // print_r($userInfo);

        if (empty($userInfo)) {
            $msg = "Không tồn tại tài khoản : " . $_POST['ma_kh'];
        } else {
            //kiểm tra pass
            // if(password_verify($mat_khau, $userInfo['mat_khau'])){
            if (($mat_khau) == $userInfo['mat_khau']) {
                //đúng pass
                if (exist_param("ghi_nho")) {
                    add_cookie("ma_kh", $ma_kh, 30);
                    add_cookie("mat_khau", $mat_khau, 30);
                } else {
                    delete_cookie("ma_kh");
                    delete_cookie("mat_khau");
                }
                $_SESSION["ma_kh"] = $userInfo;
                $msg = "Đăng nhập thành công!";
                $location = $_SESSION['tk_http_referer'];
                header("location: $location");
            } else {
                $msg = "Sai password!";
            }
        }
    }
    return [
        'view_name' => 'user/login.php',
        'msg' => $msg
    ];
}

function DangXuat()
{
    unset($_SESSION['ma_kh']);
    header("Location:?controller=user&action=login");
    return [
        'view_name' => 'user/login.php',
    ];
}

function QuenMatKhau()
{
    if (isset($_POST['btn_gui'])) {
        //1. Key dưới đây chỉ dùng tạm, khi chạy dịch vụ chính thức bạn cần đăng ký tài khoản của sendgrid.com
        // website nhỏ thì dùng tài khoản miễn phí ok
        // tham khảo cách đăng ký để lấy key https://saophaixoan.net/search-tut?q=sendgrid
        // trong code này chỉ cần lấy key là ok, sau khi gửi thử xong thì verify là ok.
        $SENDGRID_API_KEY = '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';
        extract($_POST);
        require_once APP_PATH . '/public/sendmail-sendgrid/vendor/autoload.php';

        $user = user_get_one_by_email(['email' => $email1]);
        print_r($user);
        die();
        $email = new \SendGrid\Mail\Mail();
        ///------- bạn chỉnh sửa các thông tin dưới đây cho phù hợp với mục đích cá nhân
        $tieu_de = "lấy lại mật khẩu ";
        // Thông tin người gửi
        $email->setFrom("huynqph10119@fpt.edu.vn", "hungpvph12160");
        // Tiêu đề thư
        $email->setSubject($tieu_de);
        // Thông tin người nhận
        $email->addTo($email1, $user['ho_ten']);
        // Soạn nội dung cho thư
        // $email->addContent("text/plain", "Nội dung text thuần không có thẻ html");
        $email->addContent(
            "text/html",
            "mật khẩu của bạn là : " . $user['mat_khau']
        );
        // die('hung');
        // tiến hành gửi thư
        $sendgrid = new \SendGrid($SENDGRID_API_KEY);
        try {
            $response = $sendgrid->send($email);
            //--- mấy dòng print này thích in ra thì in.
            // print $response->statusCode() . "\n";
            // print_r($response->headers());
            // print $response->body() . "\n";
            echo "gui thanh cong";
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }

    return [
        'view_name' => 'user/forgot.php',
    ];
}

function add_user()
{
    $err = ['ho_ten' => '', 'mat_khau' => '', 'hinh' => '', 'email' => '', 'so_dt' => ''];
    if (isset($_POST['btnSave'])) {
        extract($_POST); //bung mảng post thành các biến tự do
        // $mat_khau = password_hash($mat_khau, PASSWORD_DEFAULT);
        //validate
        $validate_ma_kh = '/^[a-zA-Z0-9_]{5,30}$/';
        $validate_hoten = '/^[a-zA-ZàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD ]{10,50}$/';

        $validate_phone = '/((09|03|07|08|05)+([0-9]{8})\b)/';
        $validate_password = '/^[a-zA-Z0-9_]{6,30}$/';
        // $validate_email = '/^[A-Za-z0-9_.]{3,32}@(gmail.com)+$/';
        $type_img = ['image/png', 'image/jpeg', 'image/bmp'];
        $name_img = $_FILES['hinh']['type'];
        //validate họ tên
        if (!preg_match($validate_hoten, $ho_ten)) {
            $err['ho_ten'] = "<small class='text-danger'>*Họ tên phải đúng định dạng và tối thiểu 10 ký tự !</small>";
        }
        //validate mã kh
        if (!preg_match($validate_ma_kh, $ma_kh)) {
            $err['ma_kh'] = "<small class='text-danger'>*Mã KH phải đúng định dạng và tối thiểu 5 ký tự !</small>";
        }
        if (khach_hang_exist($ma_kh)) {
            $err['ma_kh'] = "<small class='text-danger'>*Mã KH đã được sử dụng !</small>";
        }
        //validate mật khẩu
        if (!preg_match($validate_password, $mat_khau)) {
            $err['mat_khau'] = "<small class='text-danger'>*Mật khẩu tối thiểu 6 ký tự!</small>";
        }

        if ($mat_khau2 != $mat_khau) {
            $err['mat_khau2'] = "<small class='text-danger'>*Mật khẩu không trùng khớp!</small>";
        }

        //validate file ảnh tải lên
        if ($_FILES['hinh']['size'] > 0 && $_FILES['hinh']['size'] < 1500000) {
            if (in_array($name_img, $type_img) === false) {
                $err['hinh'] = "<small class='text-danger'>*Chỉ được up hình có định dạng là JPG PNG và BMP!</small>";
            } else {
                $hinh = $_FILES['hinh']['size'];
            }
        } else {
            $err['hinh'] = "<small class='text-danger'>*Không để trống và < 2MB</small>";
        }
        //validate email
        // if (!preg_match($validate_email, $email)) {
        //     $err['email'] = "<small class='text-danger'>*Email sai định dạng hoặc không được để trống!</small>";
        // }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err['email'] = "<small class='text-danger'>*Email sai định dạng hoặc không được để trống!</small>";
        }
        //validate số điện thoại
        if (!preg_match($validate_phone, $so_dt)) {
            $err['so_dt'] = "<small class='text-danger'>*Số  điện thoại sai định dạng hoặc không được để trống !</small>";
        }


        //nếu k có lỗi thì ghi csdl
        if (!array_filter($err)) {
            $up_hinh = save_file("hinh", IMAGE_DIR . "/user/");
            $hinh = strlen($up_hinh) > 0 ? $up_hinh : 'user.png';
            //tạo mảng tham số để lưu csdl, key của mảng là tên cột trong csdl
            $kich_hoat = 0;
            $dataInsert = [
                'ma_kh' => $ma_kh,
                'ho_ten' => $ho_ten,
                'mat_khau' => $mat_khau,
                'kich_hoat' => $kich_hoat == 0,
                'hinh' => $hinh,
                'email' => $email,
                'so_dt' => $so_dt,
                'vai_tro' => $vai_tro == 1
            ];
            user_add($dataInsert);
            $msg = "Thêm mới thành công";
        }
    }
    return [
        'view_name' => 'user/register.php',
        'new_id' => @$last_id,
        'msg' => @$msg,
        'err' => $err
    ];
}
function edit_user()
{

    // if (empty($_GET['id'])) {
    //     header("location:" . BASE_URL . "/?module=backend&controller=index&action=404&error=Không xác định được mã khách hàng!");
    // }
    if (empty(user_get_one(['ma_kh' => $_GET['id']]))) {
        header("location:" . BASE_URL . "/?module=backend&controller=index&action=404&error=Mã khách hàng không tồn tại ! ");
    }
    $err = ['ho_ten' => '', 'mat_khau' => '', 'hinh' => '', 'email' => '', 'so_dt' => ''];
    if (isset($_POST['btnSave'])) {
        extract($_POST);
        //nếu k có lỗi thì ghi csdl
        $validate_hoten = '/^[a-zA-ZàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD ]{10,50}$/';
        // $validate_ma_kh = '/^[a-zA-Z0-9_]{5,30}$/';
        $validate_phone = '/((09|03|07|08|05)+([0-9]{8})\b)/';
        $validate_password = '/^[a-zA-Z0-9_]{6,30}$/';
        // $validate_email = '/^[A-Za-z0-9_.]{3,32}@(gmail.com)+$/';
        $type_img = ['image/png', 'image/jpeg', 'image/bmp'];
        $name_img = $_FILES['up_hinh']['type'];
        //validate họ tên
        if (!preg_match($validate_hoten, $ho_ten)) {
            $err['ho_ten'] = "<small class='text-danger'>*Họ tên phải đúng định dạng và tối thiểu 10 ký tự !</small>";
        }
        //validate mật khẩu
        if (!preg_match($validate_password, $mat_khau)) {
            $err['mat_khau'] = "<small class='text-danger'>*Mật khẩu tối thiểu 6 ký tự!</small>";
        }
        if ($mat_khau2 != $mat_khau) {
            $err['mat_khau2'] = "<small class='text-danger'>*Mật khẩu không trùng khớp!</small>";
        }

        //validate file ảnh tải lên
        if (isset($up_hinh)) {
            if ($_FILES['up_hinh']['size'] > 0 && $_FILES['up_hinh']['size'] < 1500000) {
                if (in_array($name_img, $type_img) === false) {
                    $err['hinh'] = "<small class='text-danger'>*Chỉ được up hình có định dạng là JPG PNG và BMP!</small>";
                } else {
                    $hinh = $_FILES['up_hinh']['size'];
                }
            } else {
                $err['hinh'] = "<small class='text-danger'>*Không để trống và < 2MB</small>";
            }
        }
        //validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err['email'] = "<small class='text-danger'>*Email sai định dạng hoặc không được để trống!</small>";
        }
        //validate số điện thoại
        if (!preg_match($validate_phone, $so_dt)) {
            $err['so_dt'] = "<small class='text-danger'>*Số  điện thoại sai định dạng hoặc không được để trống !</small>";
        }

        if (!array_filter($err)) {
            $up_hinh = save_file("up_hinh", IMAGE_DIR . "/user/");
            $hinh = strlen($up_hinh) > 0 ? $up_hinh : $hinh;
            //tạo mảng tham số để lưu csdl, key của mảng là tên cột trong csdl
            $kich_hoat = 1;
            $vai_tro = 0;
            $dataUpdate = [
                'ma_kh' => $ma_kh,
                'ho_ten' => $ho_ten,
                'mat_khau' => $mat_khau,
                'kich_hoat' => $kich_hoat == 1,
                'hinh' => $hinh,
                'email' => $email,
                'so_dt' => $so_dt,
                'vai_tro' => $vai_tro == 0
            ];
            user_edit($dataUpdate);
            $msg = "Cập nhật thành công!";
        }
    }
    return [
        'view_name' => 'user/edit.php',
        'new_id' => @$last_id,
        'msg' => @$msg,
        'err' => $err
    ];
}
function delete_user()
{
    user_delete(['ma_kh' => $_GET['id']]);
    $msg = "Xóa thành công";
    $list_user = user_list_all();
    return [
        'view_name' => 'user/list.php',
        'list_user' => $list_user,
        'msg' => @$msg
    ];
}
