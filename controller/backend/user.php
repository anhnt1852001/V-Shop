<?php
require_once APP_PATH . '/model/user_model.php';
require_once APP_PATH . '/library/functions.php';
// đặt tên các action
// adđ: thêm mới
//edit :sửa
// index: danh sách
// delete: xóa
switch ($action) {
    case 'add':
        extract(add_user());
        break;
    case 'edit':
        extract(edit_user());
        break;
    case 'delete':
        extract(delete_user());
        break;
    case 'view':
        extract(view_user());
        break;
    default:
        if (isset($_POST['btn-delete-multi'])) {
            extract(delete_multi());
        }
        extract(Index());
        break;
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
            $dataInsert = [
                'ma_kh' => $ma_kh,
                'ho_ten' => $ho_ten,
                'mat_khau' => $mat_khau,
                'kich_hoat' => $kich_hoat == 1,
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
        'view_name' => 'user/add.php',
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
            $dataUpdate = [
                'ma_kh' => $ma_kh,
                'ho_ten' => $ho_ten,
                'mat_khau' => $mat_khau,
                'kich_hoat' => $kich_hoat == 1,
                'hinh' => $hinh,
                'email' => $email,
                'so_dt' => $so_dt,
                'vai_tro' => $vai_tro == 1
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
function delete_multi()
{
    $mang_id = $_POST['ma_kh'];
    $kqxoa = user_delete_multi(implode(',', $mang_id));
    return [
        'kq' => $kqxoa,
    ];
}

function view_user()
{

    return [
        'view_name' => 'user/view.php',
    ];
}
function Index()
{
    $list_user = user_list_all();
    return [
        'view_name' => 'user/list.php',
        'list_user' => $list_user
    ];
}
