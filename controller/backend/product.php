<?php
require_once APP_PATH . '/model/product_model.php';
require_once APP_PATH . '/model/categories_model.php';
require_once APP_PATH . '/model/trademark_model.php';
require_once APP_PATH . '/model/slide_model.php';
require_once APP_PATH . '/library/functions.php';
// đặt tên các action
// adđ: thêm mới
//edit :sửa
// index: danh sách
// delete: xóa
switch ($action) {
    case 'add':
        extract(add_product());
        break;
    case 'edit':
        extract(edit_product());
        break;
    case 'delete':
        extract(delete_product());
        break;
    case 'view':
        extract(view_product());
        break;
    default:
        if (isset($_POST['btn-delete-multi'])) {
            extract(delete_multi());
        }
        extract(Index());
        break;
}

function add_product()
{
    $err = ['ten_hh' => '', 'don_gia' => '', 'giam_gia' => '', 'hinh' => '', 'ngay_nhap' => '', 'mo_ta' => '', 'ram' => '', 'storage' => '', 'so_luong' => '']; //mảng chứa lỗi
    if (isset($_POST['btnSave'])) {
        extract($_POST); //bung mảng post thành các biến tự do
        $type_img = ['image/png', 'image/jpeg', 'image/bmp'];
        $name_img = $_FILES['hinh']['type'];
        $validate_ten_hh = '/^[a-zA-ZàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD ]{5,50}$/';
        // validate tên hàng hóa
        if (!preg_match($validate_ten_hh, $ten_hh)) {
            $err['ten_hh'] = "<small class='text-danger'>*Tên hàng hóa phải đúng định dạng và tối thiểu 5 ký tự !</small>";
        }
        // validate đơn giá
        if (trim($don_gia) == '') {
            $err['don_gia'] = "<small class='text-danger'>*Đơn giá không được để trống!</small>";
            if ($don_gia < 0) {
                $err['don_gia'] = "<small class='text-danger'>*Đơn giá phải là 1 số dương !</small>";
            }
        }
        // validate số lượng
        if (trim($so_luong) == '') {
            $err['so_luong'] = "<small class='text-danger'>*Số lượng không được để trống!</small>";
            if ($so_luong < 0) {
                $err['so_luong'] = "<small class='text-danger'>*Số lượng phải là 1 số dương !</small>";
            }
        }
        // validate ram
        if (trim($ram) == '') {
            $err['ram'] = "<small class='text-danger'>*Ram không được để trống!</small>";
            if ($ram < 0) {
                $err['ram'] = "<small class='text-danger'>*Ram giá phải là 1 số dương !</small>";
            }
        }
        // validate storage
        if (trim($storage) == '') {
            $err['storage'] = "<small class='text-danger'>*Storage không được để trống!</small>";
            if ($storage < 0) {
                $err['storage'] = "<small class='text-danger'>*Storage phải là 1 số dương !</small>";
            }
        }
        // validate giảm giá
        if (trim($giam_gia) == '') {
            $err['giam_gia'] = "<small class='text-danger'>*Giảm giá không được để trống!</small>";
            if ($giam_gia < 0) {
                $err['giam_gia'] = "<small class='text-danger'>*Giảm giá phải là 1 số dương !</small>";
            }
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
        if (empty($ngay_nhap)) {
            $err['ngay_nhap'] = "<small class='text-danger'>* Ngày nhập không được để trống </small>";
        }
        //validate ngày nhập
        if (empty($mo_ta)) {
            $err['mo_ta'] = "<small class='text-danger'>*Mô tả không được để trống!</small>";
        }
        //nếu k có lỗi thì ghi csdl
        if (!array_filter($err)) {
            $up_hinh = save_file("hinh", IMAGE_DIR . "/product/");
            $hinh = strlen($up_hinh) > 0 ? $up_hinh : 'product.png';
            //banner
            $up_banner = save_file("banner", IMAGE_DIR . "/banner/");
            $banner = strlen($up_banner) > 0 ? $up_banner : 'banner.png';
            // slide
            $up_ten_slide1 = save_file("ten_slide1", IMAGE_DIR . "/slides/");
            $ten_slide1 = strlen($up_ten_slide1) > 0 ? $up_ten_slide1 : 'slides.png';
            $up_ten_slide2 = save_file("ten_slide2", IMAGE_DIR . "/slides/");
            $ten_slide2 = strlen($up_ten_slide2) > 0 ? $up_ten_slide2 : 'slides.png';
            $up_ten_slide3 = save_file("ten_slide3", IMAGE_DIR . "/slides/");
            $ten_slide3 = strlen($up_ten_slide3) > 0 ? $up_ten_slide3 : 'slides.png';
            $up_ten_slide4 = save_file("ten_slide4", IMAGE_DIR . "/slides/");
            $ten_slide4 = strlen($up_ten_slide4) > 0 ? $up_ten_slide4 : 'slides.png';
            $up_ten_slide5 = save_file("ten_slide5", IMAGE_DIR . "/slides/");
            $ten_slide5 = strlen($up_ten_slide5) > 0 ? $up_ten_slide5 : 'slides.png';
            //tạo mảng tham số để lưu csdl, key của mảng là tên cột trong csdl
            $dataInsert = [
                'ten_hh' => $ten_hh,
                'ma_th' => $ma_th,
                'ma_mh' => $ma_mh,
                'don_gia' => $don_gia,
                'giam_gia' => $giam_gia,
                'hinh' => $hinh,
                'ngay_nhap' => $ngay_nhap,
                'mo_ta' => $mo_ta,
                'dac_biet' => $dac_biet == 1,
                'so_luot_xem' => $so_luot_xem,
                'banner' => $banner,
                'ram' => $ram,
                'storage' => $storage,
                'so_luong' => $so_luong,
                'status' => $status == 1
            ];
            $last_id = product_add($dataInsert);
            $dataInsert2 = [
                'ma_slide' => $ma_slide,
                'ten_slide1' => $ten_slide1,
                'ten_slide2' => $ten_slide2,
                'ten_slide3' => $ten_slide3,
                'ten_slide4' => $ten_slide4,
                'ten_slide5' => $ten_slide5,
                'ma_hh' => $last_id
            ];
            slide_add($dataInsert2);

            $msg = "Thêm mới thành công";
        }
    }
    return [
        'view_name' => 'product/add.php',
        'new_id' => @$last_id,
        'err' => $err,
        'msg' => @$msg
    ];
}
function edit_product()
{

    if (empty($_GET['id'])) {
        header("location:" . BASE_URL . "/?module=backend&controller=index&action=404&error=Không tồn tại mã hàng hóa cần sửa");
    }
    if (empty(product_get_one(['ma_hh' => $_GET['id']]))) {
        header("location:" . BASE_URL . "/?module=backend&controller=index&action=404&error=Mã hàng hóa không tồn tại!");
    }
    $err = ['ten_hh' => '', 'don_gia' => '', 'giam_gia' => '', 'ngay_nhap' => '', 'mo_ta' => '', 'so_luong' => '', 'ram' => '', 'storage' => '']; //mảng chứa lỗi
    if (isset($_POST['btnSave'])) {
        extract($_POST); //bung mảng post thành các biến tự do
        $type_img = ['image/png', 'image/jpeg', 'image/bmp'];
        $name_img = $_FILES['up_hinh']['type'];
        $validate_ten_hh = '/^[a-zA-ZàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD ]{10,50}$/';
        // validate tên hàng hóa
        if (!preg_match($validate_ten_hh, $ten_hh)) {
            $err['ten_hh'] = "<small class='text-danger'>*Tên hàng hóa phải đúng định dạng và tối thiểu 10 ký tự !</small>";
        }
        // validate đơn giá
        if (trim($don_gia) == '') {
            $err['don_gia'] = "<small class='text-danger'>*Đơn giá không được để trống!</small>";
            if ($don_gia < 0) {
                $err['don_gia'] = "<small class='text-danger'>*Đơn giá phải là 1 số dương !</small>";
            }
        }
        // validate số lượng
        if (trim($so_luong) == '') {
            $err['so_luong'] = "<small class='text-danger'>*Số lượng không được để trống!</small>";
            if ($so_luong < 0) {
                $err['so_luong'] = "<small class='text-danger'>*Số lượng phải là 1 số dương !</small>";
            }
        }
        // validate ram
        if (trim($ram) == '') {
            $err['ram'] = "<small class='text-danger'>*Ram không được để trống!</small>";
            if ($ram < 0) {
                $err['ram'] = "<small class='text-danger'>*Ram giá phải là 1 số dương !</small>";
            }
        }
        // validate storage
        if (trim($storage) == '') {
            $err['storage'] = "<small class='text-danger'>*Storage không được để trống!</small>";
            if ($storage < 0) {
                $err['storage'] = "<small class='text-danger'>*Storage phải là 1 số dương !</small>";
            }
        }
        // validate giảm giá
        if (trim($giam_gia) == '') {
            $err['giam_gia'] = "<small class='text-danger'>*Giảm giá không được để trống!</small>";
            if ($giam_gia < 0) {
                $err['giam_gia'] = "<small class='text-danger'>*Giảm giá phải là 1 số dương !</small>";
            }
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

        //validate ngày nhập
        if (empty($ngay_nhap)) {
            $err['ngay_nhap'] = "<small class='text-danger'>* Ngày nhập không được để trống </small>";
        }
        //validate ngày nhập
        if (empty($mo_ta)) {
            $err['mo_ta'] = "<small class='text-danger'>*Mô tả không được để trống!</small>";
        }
        //nếu k có lỗi thì ghi csdl
        if (!array_filter($err)) {
            $up_hinh = save_file("up_hinh", IMAGE_DIR . "/product/");
            $hinh = strlen($up_hinh) > 0 ? $up_hinh : $hinh;
            //banner
            $up_banner = save_file("up_banner", IMAGE_DIR . "/banner/");
            $banner = strlen($up_banner) > 0 ? $up_banner : $banner;
            //tạo mảng tham số để lưu csdl, key của mảng là tên cột trong csdl
            $dataUpdate = [
                'ma_hh' => $ma_hh,
                'ten_hh' => $ten_hh,
                'ma_th' => $ma_th,
                'ma_mh' => $ma_mh,
                'don_gia' => $don_gia,
                'giam_gia' => $giam_gia,
                'hinh' => $hinh,
                'ngay_nhap' => $ngay_nhap,
                'mo_ta' => $mo_ta,
                'dac_biet' => $dac_biet == 1,
                'so_luot_xem' => $so_luot_xem,
                'ram' => $ram,
                'storage' => $storage,
                'so_luong' => $so_luong,
                'status' => $status == 1,
                'banner' => $banner
            ];
            product_edit($dataUpdate);
            $msg = "Cập nhật thành công!";
            // header("location:?module=backend&controller=product&action=view&id=$ma_hh&message=Cập nhật thành công!");
        }
    }
    return [
        'view_name' => 'product/edit.php',
        'new_id' => @$last_id,
        'msg' => @$msg,
        'err' => @$err
    ];
}
function delete_product()
{

    product_delete(['ma_hh' => $_GET['id']]);
    $msg = "Xóa thành công";
    $list_product = product_select_page();
    $cate = categories_list_all();
    return [
        'view_name' => 'product/list.php',
        'list_product' => $list_product,
        'list_categories' => $cate,
        'msg' => @$msg
    ];
}

function delete_multi()
{
    $mang_id = $_POST['ma_hh'];
    $kqxoa = product_delete_multi(implode(',', $mang_id));
    return [
        'kq' => $kqxoa,
    ];
}



function view_product()
{
    return [
        'view_name' => 'product/view.php',
    ];
}
function Index()
{
    $cate = categories_list_all();
    $list_product = product_select_page();
    return [
        'view_name' => 'product/list.php',
        'list_product' => $list_product,
        'list_categories' => $cate
    ];
}
