<?php
require_once APP_PATH . '/model/posts_model.php';
require_once APP_PATH . '/library/functions.php';
require_once APP_PATH .'/model/product_model.php';
// đặt tên các action
// adđ: thêm mới
//edit :sửa
// index: danh sách
// delete: xóa
switch ($action) {
    case 'add':
        extract(add_posts());
        break;
    case 'edit':
        extract(edit_posts());
        break;
    case 'delete':
        extract(delete_posts());
        break;
    case 'view':
        extract(view_posts());
        break;
    default:
        if (isset($_POST['btn-delete-multi'])) {
            extract(delete_multi());
        }
        extract(Index());
        break;
}

function add_posts()
{
    $err = ['ten_bv' => '', 'hinh' => '', 'ngay_db' => '', 'mo_ta' => '', 'noi_dung' => '']; //mảng chứa lỗi
    if (isset($_POST['btnSave'])) {
        extract($_POST); //bung mảng post thành các biến tự do
        $type_img = ['image/png', 'image/jpeg', 'image/bmp'];
        $name_img = $_FILES['hinh']['type'];
        $validate_text =  '/^[a-zA-ZàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD ]{10,50}$/';
        //validate tên hàng hóa
        if (!preg_match($validate_text, $ten_bv)) {
            $err['ten_bv'] = "<small class='text-danger'>*Tên bài viết phải đúng định dạng và tối thiểu 5 ký tự !</small>";
        }

        //validate file ảnh tải lên
        if ($_FILES['hinh']['size'] > 0 && $_FILES['hinh']['size'] < 2000000) {
            if (in_array($name_img, $type_img) === false) {
                $err['hinh'] = "<small class='text-danger'>*Chỉ được up hình có định dạng là JPG PNG và BMP!</small>";
            } else {
                $hinh = $_FILES['hinh']['size'];
            }
        } else {
            $err['hinh'] = "<small class='text-danger'>*Không để trống và < 2MB</small>";
        }
        //validate ngày nhập
        if (empty($ngay_db)) {
            $err['ngay_db'] = "<small class='text-danger'>* Ngày đăng bài không được để trống </small>";
        }
        //validate mô tả
        if (!preg_match($validate_text, $mo_ta)) {
            $err['mo_ta'] = "<small class='text-danger'>*Mô tả phải đúng định dạng và tối thiểu 5 ký tự !</small>";
        }
        //validate nội dung
        if (!preg_match($validate_text, $noi_dung)) {
            $err['noi_dung'] = "<small class='text-danger'>*Nội dung phải đúng định dạng và tối thiểu 5 ký tự !</small>";
        }
        //nếu k có lỗi thì ghi csdl
        if (!array_filter($err)) {
            $up_hinh = save_file("hinh", IMAGE_DIR . "/posts/");
            $hinh = strlen($up_hinh) > 0 ? $up_hinh : 'posts.png';
            //tạo mảng tham số để lưu csdl, key của mảng là tên cột trong csdl
            $dataInsert = [
                'ten_bv' => $ten_bv,
                'ma_bv' => $ma_bv,
                'ma_hh' => $ma_hh,
                'mo_ta' => $mo_ta,
                'hinh' => $hinh,
                'ngay_db' => $ngay_db,
                'luot_xem' => $luot_xem,
                'noi_dung' => $noi_dung
            ];
            posts_add($dataInsert);
            $msg = "Thêm mới thành công";
        }
    }
    return [
        'view_name' => 'posts/add.php',
        'new_id' => @$last_id,
        'err' => $err,
        'msg' => @$msg
    ];
}
function edit_posts()
{
    if (empty($_GET['id'])) {
        header("location:" . BASE_URL . "/?module=backend&controller=index&action=404&error=Không tồn tại mã hàng hóa cần sửa");
    }
    if (empty(posts_get_one(['ma_bv' => $_GET['id']]))) {
        header("location:" . BASE_URL . "/?module=backend&controller=index&action=404&error=Mã bài viết không tồn tại!");
    }
    $err = ['ten_hh' => '', 'don_gia' => '', 'giam_gia' => '', 'ngay_nhap' => '', 'mo_ta' => '']; //mảng chứa lỗi
    if (isset($_POST['btnSave'])) {
        extract($_POST); //bung mảng post thành các biến tự do
        $type_img = ['image/png', 'image/jpeg', 'image/bmp'];
        $name_img = $_FILES['up_hinh']['type'];
        $validate_text ='/^[a-zA-ZàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD ]{10,50}$/';
        //validate tên hàng hóa
        if (!preg_match($validate_text, $ten_bv)) {
            $err['ten_bv'] = "<small class='text-danger'>*Tên bài viết phải đúng định dạng và tối thiểu 5 ký tự !</small>";
        }

        //validate file ảnh tải lên
        if(isset($up_hinh)){
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
        //validate ngày nhập
        if (empty($ngay_db)) {
            $err['ngay_db'] = "<small class='text-danger'>* Ngày đăng bài không được để trống </small>";
        }
        //validate mô tả
        if (!preg_match($validate_text, $mo_ta)) {
            $err['mo_ta'] = "<small class='text-danger'>*Mô tả phải đúng định dạng và tối thiểu 5 ký tự !</small>";
        }
        //validate nội dung
        if (!preg_match($validate_text, $noi_dung)) {
            $err['noi_dung'] = "<small class='text-danger'>*Nội dung phải đúng định dạng và tối thiểu 5 ký tự !</small>";
        }
        //nếu k có lỗi thì ghi csdl
        if (!array_filter($err)) {
            $up_hinh = save_file("up_hinh", IMAGE_DIR . "/posts/");
            $hinh = strlen($up_hinh) > 0 ? $up_hinh : $hinh;
            //tạo mảng tham số để lưu csdl, key của mảng là tên cột trong csdl
            $dataUpdate = [
                'ten_bv' => $ten_bv,
                'ma_bv' => $ma_bv,
                'ma_hh' => $ma_hh,
                'mo_ta' => $mo_ta,
                'hinh' => $hinh,
                'ngay_db' => $ngay_db,
                'luot_xem' => $luot_xem,
                'noi_dung' => $noi_dung
            ];
            posts_edit($dataUpdate);
            $msg = "Cập nhật thành công!";
        }
    }
    return [
        'view_name' => 'posts/edit.php',
        'new_id' => @$last_id,
        'msg' => @$msg,
        'err' => @$err
    ];
}
function delete_posts()
{

    posts_delete(['ma_bv' => $_GET['id']]);
    $msg = "Xóa thành công";
    $list_posts = posts_list_all();
    return [
        'view_name' => 'posts/list.php',
        'list_posts' => $list_posts,
        'msg' => @$msg
    ];
}

function delete_multi()
{
    $mang_id = $_POST['ma_bv'];
    $msg = "Xóa thành công";
    $kqxoa = posts_delete_multi(implode(',', $mang_id));
    return [
        'kq' => $kqxoa,
        'msg' => @$msg
    ];
}



function view_posts()
{
    return [
        'view_name' => 'posts/view.php',
    ];
}
function Index()
{
    $list_posts = posts_select_page();
    $list_product=product_list_all();
    return [
        'view_name' => 'posts/list.php',
        'list_posts' => $list_posts,
        'list_product'=>$list_product
    ];
}
